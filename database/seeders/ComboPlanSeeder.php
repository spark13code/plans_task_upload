<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\plan;
use App\Models\ComboPlan;

class ComboPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0; $i < 1500; $i++) {
            $ComboPlan = new ComboPlan();
            $ComboPlan->name = 'Combo ' . $i;
            $ComboPlan->price = rand(10, 100);
            $ComboPlan->save();

            $randomIds = Plan::inRandomOrder()->limit(5)->pluck('id')->toArray();
            $ComboPlan->plans()->sync($randomIds); 
        }
        

    }
}
