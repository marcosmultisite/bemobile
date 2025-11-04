<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Cria 15 produtos falsos usando a factory
        Product::factory()->count(150)->create();
    }
}
