<?php

declare(strict_types=1);

namespace App\Infrastructure\Common\Interfaces;

use App\Infrastructure\Base\Interfaces\RUIDModelInterface;

interface RUIDServiceInterface
{
    /**
     * Generates RUID (Resource Unique ID).
     *
     * @param RUIDModelInterface $model
     *
     * @return string
     */
    public function generate(RUIDModelInterface $model): string;
}
