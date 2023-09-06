<?php

declare(strict_types=1);

namespace App\Domains\User\Seeders;

use App\Domains\User\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     *
     * @codeCoverageIgnore
     */
    public function run(): void
    {
        $email = 'default.user@domain.com';

        if (!User::where('email', $email)->exists()) {
            $user = User::factory()->create([
                'firstname' => 'Default',
                'lastname'  => 'User',
                'email'     => $email,
                'password'  => Hash::make('123456'),
            ]);
            $user->createToken($email);
        }
    }
}
