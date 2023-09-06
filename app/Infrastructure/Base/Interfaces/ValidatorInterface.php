<?php

declare(strict_types=1);

namespace App\Infrastructure\Base\Interfaces;

interface ValidatorInterface
{
    /**
     * Validation rules.
     *
     * @see https://lumen.laravel.com/docs/8.x/validation
     *
     * @return array
     */
    public static function rules(): array;
}
