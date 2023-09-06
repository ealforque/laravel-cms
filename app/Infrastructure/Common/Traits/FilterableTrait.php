<?php

namespace App\Infrastructure\Common\Traits;

trait FilterableTrait
{
    public function getFilterableColumns(): array
    {
        return self::FILTERABLE_COLUMNS;
    }
}
