<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    function run(){
        /****/
        User::factory(50)->create();    
        Transaction::factory(250)->create();
        $this->call([
            GatewaySeeder::class,
            ClientSeeder::class,
            ProductSeeder::class,
        ]);
        /***/
    }
}
