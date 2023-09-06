<?php

declare(strict_types=1);

namespace App\Infrastructure\Common\Services;

use App\Infrastructure\Base\DTOs\BasePaginatorDTO;
use App\Infrastructure\Common\DTOs\CursorPaginatorDTO;
use App\Infrastructure\Common\DTOs\OffsetPaginatorDTO;
use App\Infrastructure\Common\Interfaces\FractalServiceInterface;
use App\Infrastructure\Common\Interfaces\PaginatorServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;

class PaginatorService implements PaginatorServiceInterface
{
    /**
     * @var const string[]
     */
    public const DEFAULT_COLUMNS = ['*'];

    /**
     * @var const string
     */
    public const DEFAULT_CURSORNAME = 'cursor';

    /**
     * @var const string
     */
    public const DEFAULT_PAGENAME = 'page';

    /**
     * Paginate.
     *
     * @param string                  $paginate
     * @param Builder                 $builder
     * @param BasePaginatorDTO        $dto
     * @param FractalServiceInterface $fractal
     *
     * @return array
     */
    public function paginate(string $paginate, Builder $builder, BasePaginatorDTO $dto, FractalServiceInterface $fractal): array
    {
        switch($paginate) {
            case 'cursor':
                return $this->cursorPaginate($builder, $dto, $fractal);
                break;
            default:
                return $this->offsetPaginate($builder, $dto, $fractal);
                break;
        }
    }

    /**
     * Cursor Paginate.
     *
     * @param Builder                 $builder
     * @param CursorPaginatorDTO      $dto
     * @param FractalServiceInterface $fractal
     *
     * @return array
     */
    private function cursorPaginate(Builder $builder, CursorPaginatorDTO $dto, FractalServiceInterface $fractal): array
    {
        $paginator = $builder->cursorPaginate(
            $dto->getLimit(),
            self::DEFAULT_COLUMNS,
            self::DEFAULT_CURSORNAME,
            $dto->getCursor()
        );
        $list = $paginator->items();

        $resource = new Collection($list, $fractal->getTransformer());

        $resource->setMetaValue('cursor', [
            'next' => $paginator->nextCursor()?->encode(),
            'prev' => $paginator->previousCursor()?->encode(),
        ]);
        $resource->setMetaValue('query', $dto->getQueryParameters());

        return $fractal->transform($resource);
    }

    /**
     * Offset Paginate.
     *
     * @param Builder                 $builder
     * @param OffsetPaginatorDTO      $dto
     * @param FractalServiceInterface $fractal
     *
     * @return array
     */
    private function offsetPaginate(Builder $builder, OffsetPaginatorDTO $dto, FractalServiceInterface $fractal): array
    {
        $paginator = $builder->paginate(
            $dto->getPerPage(),
            self::DEFAULT_COLUMNS,
            self::DEFAULT_PAGENAME,
            $dto->getPage()
        );
        $list = $paginator->items();

        $resource = new Collection($list, $fractal->getTransformer());
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));

        return $fractal->transform($resource);
    }
}
