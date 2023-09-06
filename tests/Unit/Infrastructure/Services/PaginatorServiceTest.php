<?php

declare(strict_types=1);

namespace App\Tests\Common\Services;

use App\Domains\User\Models\User;
use App\Infrastructure\Common\DTOs\CursorPaginatorDTO;
use App\Infrastructure\Common\DTOs\OffsetPaginatorDTO;
use App\Infrastructure\Common\Interfaces\FractalServiceInterface;
use App\Infrastructure\Common\Services\PaginatorService;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Pagination\Cursor;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Resource\Collection;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class PaginatorServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testCursorPaginate()
    {
        $service = new PaginatorService();

        /**
         * @var CursorPaginatorDTO&MockInterface
         */
        $dto = Mockery::mock(CursorPaginatorDTO::class);
        $dto
            ->shouldReceive('getLimit')
            ->once()
            ->withNoArgs()
            ->andReturn(5);

        $dto
            ->shouldReceive('getCursor')
            ->once()
            ->withNoArgs()
            ->andReturn(null);

        $users = User::factory()->count(25)->create();

        /**
         * @var CursorPaginator&MockInterface
         */
        $paginator = Mockery::mock(CursorPaginator::class);
        $paginator
            ->shouldReceive('items')
            ->once()
            ->withNoArgs()
            ->andReturn(
                new Collection($users)
            );

        /**
         * @var Builder&MockInterface
         */
        $builder = Mockery::mock(Builder::class);
        $builder
            ->shouldReceive('cursorPaginate')
            ->with(5, PaginatorService::DEFAULT_COLUMNS, PaginatorService::DEFAULT_CURSORNAME, null)
            ->andReturn($paginator);

        /**
         * @var FractalServiceInterface&MockInterface
         */
        $fractal = Mockery::mock(FractalServiceInterface::class);
        $fractal
            ->shouldReceive('getTransformer')
            ->once()
            ->withNoArgs()
            ->andReturn(null);

        $fractal
            ->shouldReceive('transform')
            ->once()
            ->with(Collection::class)
            ->andReturn([]);

        /**
         * @var Cursor&MockInterface
         */
        $cursor = Mockery::mock(Cursor::class);
        $paginator
            ->shouldReceive('nextCursor')
            ->once()
            ->andReturn($cursor);

        $cursor
            ->shouldReceive('encode')
            ->once()
            ->andReturn('string');

        $paginator
            ->shouldReceive('previousCursor')
            ->once()
            ->andReturn($cursor);

        $cursor
            ->shouldReceive('encode')
            ->once()
            ->andReturn('string');

        $dto
            ->shouldReceive('getQueryParameters')
            ->once()
            ->andReturn([]);

        $result = $service->paginate('cursor', $builder, $dto, $fractal);

        $this->assertIsArray($result);
    }

    public function testOffsetPaginate()
    {
        $service = new PaginatorService();

        /**
         * @var MockInterface&OffsetPaginatorDTO
         */
        $dto = Mockery::mock(OffsetPaginatorDTO::class);
        $dto
            ->shouldReceive('getPerPage')
            ->once()
            ->withNoArgs()
            ->andReturn(5);

        $dto
            ->shouldReceive('getPage')
            ->once()
            ->withNoArgs()
            ->andReturn(1);

        $users = User::factory()->count(25)->create();

        /**
         * @var LengthAwarePaginator&MockInterface
         */
        $paginator = Mockery::mock(LengthAwarePaginator::class);
        $paginator
            ->shouldReceive('items')
            ->once()
            ->withNoArgs()
            ->andReturn(
                new Collection($users)
            );

        /**
         * @var Builder&MockInterface
         */
        $builder = Mockery::mock(Builder::class);
        $builder
            ->shouldReceive('paginate')
            ->with(5, PaginatorService::DEFAULT_COLUMNS, PaginatorService::DEFAULT_PAGENAME, 1)
            ->andReturn($paginator);

        /**
         * @var FractalServiceInterface&MockInterface
         */
        $fractal = Mockery::mock(FractalServiceInterface::class);
        $fractal
            ->shouldReceive('getTransformer')
            ->once()
            ->withNoArgs()
            ->andReturn(null);

        $fractal
            ->shouldReceive('transform')
            ->once()
            ->with(Collection::class)
            ->andReturn([]);

        $result = $service->paginate('offset', $builder, $dto, $fractal);

        $this->assertIsArray($result);
    }
}
