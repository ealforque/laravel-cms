<?php

declare(strict_types=1);

namespace App\Domains\User\Factories;

use App\Domains\User\Enums\UserStatus;
use App\Domains\User\Models\User;
use App\Infrastructure\Base\Factories\BaseFactory;
use App\Infrastructure\Base\Interfaces\FactoryInterface;
use Illuminate\Support\Facades\Hash;

class UserFactory extends BaseFactory implements FactoryInterface
{
    protected $model = User::class;

    /**
     * Definition of model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'ruid'       => $this->faker->ruid(),
            'firstname'  => $this->faker->firstName,
            'lastname'   => $this->faker->lastName,
            'contact_no' => $this->faker->numerify('###########'),
            'email'      => $this->faker->uuid() . '@email.com',
            'username'   => $this->faker->userName,
            'password'   => Hash::make('123456'),
            'active'     => UserStatus::ACTIVE,
        ];
    }
}
