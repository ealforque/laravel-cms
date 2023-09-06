<?php

declare(strict_types=1);

namespace App\Infrastructure\Base\Interfaces;

interface MutateValidatorInterface
{
    /**
     * Validation rules.
     *
     * @see https://lumen.laravel.com/docs/8.x/validation
     *
     * @param ModelInterface|null $model
     *
     * @return array
     */
    public static function rules(?ModelInterface $model): array;
}
