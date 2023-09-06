<?php

declare(strict_types=1);

namespace App\Infrastructure\Common\Interfaces;

use App\Infrastructure\Base\DTOs\BasePaginatorDTO;
use Illuminate\Database\Eloquent\Builder;

interface PaginatorServiceInterface
{
    /**
     * Add paginator to query builder.
     *
     * @param string                  $pagination
     * @param Builder                 $builder
     * @param BasePaginatorDTO        $dto
     * @param FractalServiceInterface $fractal
     *
     * @return array
     */
    public function paginate(string $pagination, Builder $builder, BasePaginatorDTO $dto, FractalServiceInterface $fractal): array;
}
