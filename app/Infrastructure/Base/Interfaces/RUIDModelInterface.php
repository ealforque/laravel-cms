<?php

declare(strict_types=1);

namespace App\Infrastructure\Base\Interfaces;

interface RUIDModelInterface extends ModelInterface
{
    /**
     * Get Model object by RUID.
     *
     * @param string $ruid
     *
     * @return RUIDModelInterface|null
     */
    public static function getByRUID(string $ruid): ?RUIDModelInterface;
}
