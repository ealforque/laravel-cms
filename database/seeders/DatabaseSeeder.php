<?php

namespace Database\Seeders;

use App\Domains\Contact\Seeders\ContactSeeder;
use App\Domains\User\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (app()->environment() === 'local') {
            $this->call(UserSeeder::class);
            $this->call(ContactSeeder::class);
        }
    }
}
