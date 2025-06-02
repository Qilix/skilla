<?php

namespace Database\Factories;

use App\Models\Partnership;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartnershipFactory extends Factory
{
    protected $model = Partnership::class;
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
        ];
    }
}
