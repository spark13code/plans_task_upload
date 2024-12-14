<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\EligibleCriteriaSeeder;
use Database\Seeders\ComboPlanSeeder;
use Database\Seeders\PlanSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(EligibleCriteriaSeeder::class); 
        $this->call(ComboPlanSeeder::class); 
        $this->call(PlanSeeder::class); 
    }
}
