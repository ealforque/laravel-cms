<?php

declare(strict_types=1);

namespace App\Infrastructure\Common\Validators;

use App\Infrastructure\Base\Interfaces\ValidatorInterface;

class PaginatorValidator implements ValidatorInterface
{
    public static function rules(): array
    {
        return [
            'limit'   => 'int|min:1',
            'cursor'  => 'string',
            'perPage' => 'int|min:1',
            'page'    => 'int|min:1',
        ];
    }
}
