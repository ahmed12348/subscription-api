<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        Plan::insert([
            [
                'name' => 'Basic Plan',
                'price' => 9.99,
                'currency' => 'USD',
                'interval' => 'monthly',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pro Plan',
                'price' => 99.99,
                'currency' => 'USD',
                'interval' => 'yearly',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

