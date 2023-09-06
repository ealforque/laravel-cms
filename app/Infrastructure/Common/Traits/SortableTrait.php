<?php

namespace App\Infrastructure\Common\Traits;

trait SortableTrait
{
    public function getSortableColumns(): array
    {
        return self::SORTABLE_COLUMNS;
    }
}
