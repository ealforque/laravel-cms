<?php

declare(strict_types=1);

namespace App\Infrastructure\Common\DTOs;

use App\Infrastructure\Base\DTOs\BasePaginatorDTO;
use Illuminate\Http\Request;

class OffsetPaginatorDTO extends BasePaginatorDTO
{
    /**
     * @var const int default number of records per page
     */
    public const DEFAULT_PERPAGE = 15;

    /**
     * @var int Page number
     */
    private $page;

    /**
     * @var int Number of records per page
     */
    private $perPage;

    /**
     * Paginator DTO constuctor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->page = (int) $request->input('page', 1);
        $this->perPage = (int) $request->input('perPage', self::DEFAULT_PERPAGE);
    }

    /**
     * Page getter.
     *
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * PerPage getter.
     *
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }
}
