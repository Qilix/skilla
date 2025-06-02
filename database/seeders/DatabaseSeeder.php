<?php

namespace Database\Seeders;

use App\Models\Partnership;
use App\Models\Worker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         Partnership::factory(5)->create();
         Worker::factory(5)->create();
    }
}
