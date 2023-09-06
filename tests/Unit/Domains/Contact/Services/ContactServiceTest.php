<?php

declare(strict_types=1);

namespace Tests\Unit\Domains\Contact\Services;

use App\Domains\Contact\DTOs\ContactListDTO;
use App\Domains\Contact\Models\Contact;
use App\Domains\Contact\Repositories\ContactRepository;
use App\Domains\Contact\Services\ContactService;
use App\Domains\Contact\Transformers\ContactTransformer;
use App\Infrastructure\Common\DTOs\CursorPaginatorDTO;
use App\Infrastructure\Common\Services\FractalService;
use App\Infrastructure\Common\Services\PaginatorService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class ContactServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testGetContacts()
    {
        /**
         * @var ContactRepository&MockInterface
         */
        $contactRepositoryMock = Mockery::mock(ContactRepository::class);
        /**
         * @var MockInterface&PaginatorService
         */
        $paginatorServiceMock = Mockery::mock(PaginatorService::class);
        $contactTransformerMock = Mockery::mock(ContactTransformer::class);
        /**
         * @var FractalService&MockInterface
         */
        $fractalServiceMock = Mockery::mock(FractalService::class);
        $builderMock = Mockery::mock(Builder::class);
        /**
         * @var ContactListDTO&MockInterface
         */
        $dtoMock = Mockery::mock(ContactListDTO::class);
        $paginatorDTOMock = Mockery::mock(CursorPaginatorDTO::class);
        /**
         * @var Contact*MockInterface
         */
        $contactModelMock = Mockery::mock(Contact::class);

        $fields = 'firstname,lastname';
        $pagination = 'cursor';
        $sortParam = '-firstname';
        $filterParam = 'email_address:@gmail.com';
        $search = 'la';
        $sortableColumns = ['firstname'];
        $filterableColumns = ['email_address'];
        $searchableColumns = ['firstname', 'lastname', 'email_address'];
        $sortOrder['firstname'] = 'DESC';
        $filterData['email_address'] = '@gmail.com';

        $fractalServiceMock
            ->shouldReceive('setTransformer')
            ->once()
            ->with($contactTransformerMock)
            ->andReturn($fractalServiceMock);

        $dtoMock
            ->shouldReceive('getFields')
            ->once()
            ->withNoArgs()
            ->andReturn($fields);

        $fractalServiceMock
            ->shouldReceive('include')
            ->once()
            ->with($fields)
            ->andReturn($fractalServiceMock);

        $contactRepositoryMock
            ->shouldReceive('getListBuilder')
            ->once()
            ->withNoArgs()
            ->andReturn($builderMock);

        $dtoMock
            ->shouldReceive('getSearch')
            ->once()
            ->withNoArgs()
            ->andReturn($search);

        $contactRepositoryMock
            ->shouldReceive('getModel')
            ->once()
            ->withNoArgs()
            ->andReturn($contactModelMock);

        $contactModelMock
            ->shouldReceive('getSearchableColumns')
            ->once()
            ->withNoArgs()
            ->andReturn($searchableColumns);

        $builderMock
            ->shouldReceive('whereRaw')
            ->once()
            ->with('(firstname LIKE ? OR lastname LIKE ? OR email_address LIKE ?)', ["%$search%", "%$search%", "%$search%"])
            ->andReturn($builderMock);

        $dtoMock
            ->shouldReceive('getFilter')
            ->once()
            ->withNoArgs()
            ->andReturn($filterParam);

        $fractalServiceMock
            ->shouldReceive('filterData')
            ->once()
            ->with($filterParam)
            ->andReturn($filterData);

        $contactRepositoryMock
            ->shouldReceive('getModel')
            ->once()
            ->withNoArgs()
            ->andReturn($contactModelMock);

        $contactModelMock
            ->shouldReceive('getFilterableColumns')
            ->once()
            ->withNoArgs()
            ->andReturn($filterableColumns);

        $builderMock
            ->shouldReceive('where')
            ->with('email_address', 'LIKE', '%@gmail.com%')
            ->andReturn($builderMock);

        $dtoMock
            ->shouldReceive('getSort')
            ->once()
            ->withNoArgs()
            ->andReturn($sortParam);

        $fractalServiceMock
            ->shouldReceive('sortOrder')
            ->once()
            ->with($sortParam)
            ->andReturn($sortOrder);

        $contactRepositoryMock
            ->shouldReceive('getModel')
            ->once()
            ->withNoArgs()
            ->andReturn($contactModelMock);

        $contactModelMock
            ->shouldReceive('getSortableColumns')
            ->once()
            ->withNoArgs()
            ->andReturn($sortableColumns);

        $builderMock
            ->shouldReceive('orderBy')
            ->with('firstname', $sortOrder['firstname'])
            ->andReturn($builderMock);

        $dtoMock
            ->shouldReceive('getPaginatorDTO')
            ->once()
            ->withNoArgs()
            ->andReturn($paginatorDTOMock);

        $dtoMock
            ->shouldReceive('getPagination')
            ->once()
            ->withNoArgs()
            ->andReturn($pagination);

        $paginatorServiceMock
            ->shouldReceive('paginate')
            ->once()
            ->with(
                $pagination,
                $builderMock,
                $paginatorDTOMock,
                $fractalServiceMock
            )
            ->andReturn([]);

        $contactService = new ContactService(
            $contactRepositoryMock,
            $paginatorServiceMock,
            $contactTransformerMock,
            $fractalServiceMock
        );

        $this->assertIsArray($contactService->getContacts($dtoMock));
    }
}
