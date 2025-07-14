<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cardata=[
            [
                'chassis_no'=>'suv88',
                'model'=>'suv super',
                'color'=>"Red",
                'mgf_year'=>2018,
                'class'=>'Eclass'
            ]
            ];
            Car::insert($cardata);
    }
}
