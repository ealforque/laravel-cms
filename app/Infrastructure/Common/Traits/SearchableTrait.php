<?php

namespace App\Infrastructure\Common\Traits;

trait SearchableTrait
{
    public function getSearchableColumns(): array
    {
        return self::SEARCHABLE_COLUMNS;
    }
}
