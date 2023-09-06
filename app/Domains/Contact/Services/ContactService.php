<?php

declare(strict_types=1);

namespace App\Domains\Contact\Services;

use App\Domains\Contact\DTOs\ContactListDTO;
use App\Domains\Contact\Interfaces\ContactRepositoryInterface;
use App\Domains\Contact\Interfaces\ContactServiceInterface;
use App\Domains\Contact\Interfaces\ContactTransformerInterface;
use App\Infrastructure\Common\Interfaces\FractalServiceInterface;
use App\Infrastructure\Common\Interfaces\PaginatorServiceInterface;

class ContactService implements ContactServiceInterface
{
    /**
     * Contact repository.
     *
     * @var ContactRepositoryInterface
     */
    private ContactRepositoryInterface $contactRepository;

    /**
     * Contact transformer.
     *
     * @var ContactTransformerInterface
     */
    private ContactTransformerInterface $contactTransformer;

    /**
     * Paginator service.
     *
     * @var PaginatorServiceInterface
     */
    private PaginatorServiceInterface $paginator;

    /**
     * Fractal service.
     *
     * @var FractalServiceInterface
     */
    private FractalServiceInterface $fractal;

    /**
     * Contact service constructor.
     *
     * @param ContactRepositoryInterface  $contactRepository
     * @param PaginatorServiceInterface   $paginator
     * @param ContactTransformerInterface $contactTransformer
     * @param FractalServiceInterface     $fractal
     */
    public function __construct(
        ContactRepositoryInterface $contactRepository,
        PaginatorServiceInterface $paginator,
        ContactTransformerInterface $contactTransformer,
        FractalServiceInterface $fractal
    ) {
        $this->contactRepository = $contactRepository;
        $this->paginator = $paginator;
        $this->contactTransformer = $contactTransformer;
        $this->fractal = $fractal;
    }

    /**
     * Get contacts.
     *
     * @param ContactListDTO $dto
     *
     * @return array
     */
    public function getContacts(ContactListDTO $dto): array
    {
        $this->fractal->setTransformer($this->contactTransformer);

        $fields = $dto->getFields();
        if ($fields) {
            $this->fractal->include($fields);
        }

        $builder = $this->contactRepository->getListBuilder();

        $filter = $dto->getFilter();
        if ($filter) {
            $filterData = $this->fractal->filterData($filter);
            foreach ($filterData as $field => $value) {
                if (in_array($field, $this->contactRepository->getModel()->getFilterableColumns())) {
                    $builder->where($field, 'LIKE', "%$value%");
                }
            }
        }

        $search = $dto->getSearch();
        if ($search) {
            $searchableColumns = $this->contactRepository->getModel()->getSearchableColumns();
            $whereRawMap = [];
            $strQuery = '(';
            $count = 0;
            foreach ($searchableColumns as $column) {
                $strQuery .= "$column LIKE ?";
                if ($count != (sizeof($searchableColumns) - 1)) {
                    $strQuery .= ' OR ';
                }
                array_push($whereRawMap, "%$search%");
                $count++;
            }
            $strQuery .= ')';
            $builder->whereRaw($strQuery, $whereRawMap);
        }

        $sort = $dto->getSort();
        $sortOrder = [];
        if ($sort) {
            $sortOrder = $this->fractal->sortOrder($sort);
            foreach ($sortOrder as $name => $order) {
                if (in_array($name, $this->contactRepository->getModel()->getSortableColumns())) {
                    $builder->orderBy($name, $order);
                }
            }
        }

        return $this->paginator->paginate(
            $dto->getPagination(),
            $builder,
            $dto->getPaginatorDTO(),
            $this->fractal
        );
    }
}
