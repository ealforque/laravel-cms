<?php

declare(strict_types=1);

namespace App\Domains\Contact\DTOs;

use App\Infrastructure\Common\DTOs\CursorPaginatorDTO;
use App\Infrastructure\Common\DTOs\OffsetPaginatorDTO;
use Illuminate\Http\Request;

class ContactListDTO
{
    /**
     * @var CursorPaginatorDTO|OffsetPaginatorDTO
     */
    private $paginatorDTO;

    /**
     * @var string
     */
    private $pagination;

    /**
     * Fields to be included in the result.
     *
     * @var string|null
     */
    private ?string $fields;

    /**
     * Sort.
     *
     * @var string|null
     */
    private ?string $sort;

    /**
     * Search.
     *
     * @var string|null
     */
    private ?string $search;

    /**
     * Filter.
     *
     * @var string|null
     */
    private ?string $filter;

    /**
     * UserListDTO constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->pagination = $request->input('pagination') ?? 'offset';

        $this->paginatorDTO = new OffsetPaginatorDTO($request);
        if ($this->pagination == 'cursor') {
            $this->paginatorDTO = new CursorPaginatorDTO($request);
        }
        $this->fields = $request->input('fields');
        $this->sort = $request->input('sort');
        $this->search = $request->input('search');
        $this->filter = $request->input('filter');
    }

    /**
     * Paginator DTO getter.
     *
     * @return CursorPaginatorDTO|OffsetPaginatorDTO
     */
    public function getPaginatorDTO(): CursorPaginatorDTO|OffsetPaginatorDTO
    {
        return $this->paginatorDTO;
    }

    /**
     * Pagination getter.
     *
     * @return string|null
     */
    public function getPagination(): ?string
    {
        return $this->pagination;
    }

    /**
     * Fields getter.
     *
     * @return string|null
     */
    public function getFields(): ?string
    {
        return $this->fields;
    }

    /**
     * Sort getter.
     *
     * @return string|null
     */
    public function getSort(): ?string
    {
        return $this->sort;
    }

    /**
     * Search getter.
     *
     * @return string|null
     */
    public function getSearch(): ?string
    {
        return $this->search;
    }

    /**
     * Filter getter.
     *
     * @return string|null
     */
    public function getFilter(): ?string
    {
        return $this->filter;
    }
}
