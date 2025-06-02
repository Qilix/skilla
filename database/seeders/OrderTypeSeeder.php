<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Погрузка/Разгрузка'],
            ['name' => 'Такелажные работы'],
            ['name' => 'Уборка'],
        ];

        foreach ($types as $type) {
            \App\Models\OrderType::create($type);
        }
    }
}
