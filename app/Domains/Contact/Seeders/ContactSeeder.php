<?php

declare(strict_types=1);

namespace App\Domains\Contact\Seeders;

use App\Domains\Contact\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
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
        Contact::factory(10)->create();
    }
}
