<?php

declare(strict_types=1);

namespace App\Infrastructure\Common\DTOs;

use App\Infrastructure\Base\DTOs\BasePaginatorDTO;
use Illuminate\Http\Request;

class CursorPaginatorDTO extends BasePaginatorDTO
{
    /**
     * @var const int default number of records per page
     */
    public const DEFAULT_PERPAGE = 15;

    /**
     * @var int Number of records per page
     */
    private $limit;

    /**
     * @var string current cursor
     */
    private $cursor;

    /**
     * @var array queryParameter
     */
    private $queryParameters;

    /**
     * Cursor Paginator DTO constuctor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->limit = (int) $request->input('limit', self::DEFAULT_PERPAGE);
        $this->cursor = (string) $request->input('cursor');
        $this->queryParameters = (array) $request->input();
    }

    /**
     * Limit getter.
     *
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * Current cursor getter.
     *
     * @return ?string
     */
    public function getCursor(): ?string
    {
        return $this->cursor ?? null;
    }

    /**
     * Query parameter getter.
     *
     * @return array
     */
    public function getQueryParameters(): array
    {
        unset($this->queryParameters['cursor']);

        return $this->queryParameters ?? [];
    }
}
