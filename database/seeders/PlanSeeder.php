<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        for ($i = 0; $i < 1500; $i++) {
            $data[] = [
                'name' => 'Plan ' . $i,
                'description' => 'This is a sample plan description.',
                'price' => rand(10, 100), 
            ];
        }

        plan::insert($data);
    }
}
