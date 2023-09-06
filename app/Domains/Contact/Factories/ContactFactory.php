<?php

declare(strict_types=1);

namespace App\Domains\Contact\Factories;

use App\Domains\Contact\Models\Contact;
use App\Infrastructure\Base\Factories\BaseFactory;
use App\Infrastructure\Base\Interfaces\FactoryInterface;

class ContactFactory extends BaseFactory implements FactoryInterface
{
    protected $model = Contact::class;

    /**
     * Definition of model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'ruid'          => $this->faker->ruid(),
            'firstname'     => $this->faker->firstName,
            'lastname'      => $this->faker->lastName,
            'contact_no'    => $this->faker->numerify('###########'),
            'email_address' => $this->faker->email,
            'user_id'       => 1,
        ];
    }
}
