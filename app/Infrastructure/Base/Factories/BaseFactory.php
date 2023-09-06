<?php

declare(strict_types=1);

namespace App\Infrastructure\Base\Factories;

use App\Infrastructure\Base\Interfaces\FactoryInterface;
use Illuminate\Database\Eloquent\Factories\Factory;

abstract class BaseFactory extends Factory implements FactoryInterface
{
    /**
     * Definition of the model's default state.
     *
     * @return array
     */
    abstract public function definition(): array;
}
