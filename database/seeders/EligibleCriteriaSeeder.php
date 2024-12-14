<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\EligibleCriteria;

class EligibleCriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 1500; $i++) {
            $EligibleCriteria = new EligibleCriteria();
            $EligibleCriteria->name = 'Random ' . $i;
            $EligibleCriteria->age_less_than = rand(90, 100);
            $EligibleCriteria->age_greater_than = rand(01, 20);
            $EligibleCriteria->last_login_days_ago = rand(0, 100);
            $EligibleCriteria->income_less_than = rand(10000, 1000000);
            $EligibleCriteria->income_greater_than = rand(10000, 1000000);
            $EligibleCriteria->save();
        }
        
    }
}
