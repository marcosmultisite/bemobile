<?php

namespace Database\Seeders;

use App\Models\Gateway;
use Illuminate\Database\Seeder;

class GatewaySeeder extends Seeder
{
    public function run(): void
    {
        Gateway::create(['name' => 'Stripe', 'is_active' => true, 'priority' => 1]);
        Gateway::create(['name' => 'PagSeguro', 'is_active' => true, 'priority' => 2]);
        Gateway::create(['name' => 'PayPal', 'is_active' => false, 'priority' => 3]);
    }
}
