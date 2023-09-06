<?php

declare(strict_types=1);

namespace App\Infrastructure\Base\Models;

use App\Infrastructure\Base\Interfaces\FactoryInterface;
use App\Infrastructure\Base\Interfaces\ModelInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model implements ModelInterface
{
    /**
     * Get a new factory instance of a specific model.
     *
     * @return FactoryInterface|null
     */
    abstract protected static function newFactory(): ?FactoryInterface;
}
