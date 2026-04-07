<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ward;

class WardSeeder extends Seeder
{
    public function run(): void
    {
        $wards = [
            [
                'constituency_id' => 1,
                'name' => 'Ward 1',
                'number' => 1,
                'status' => 1,
                'type' => 'Urban',
                'boundry' => 'Dummy boundary data',
                'x_min' => 12.971598,
                'x_max' => 12.975000,
                'y_min' => 77.594566,
                'y_max' => 77.600000
            ],
            [
                'constituency_id' => 1,
                'name' => 'Ward 2',
                'number' => 2,
                'status' => 1,
                'type' => 'Urban',
                'boundry' => 'Dummy boundary data',
                'x_min' => 12.960000,
                'x_max' => 12.965000,
                'y_min' => 77.580000,
                'y_max' => 77.585000
            ],
            [
                'constituency_id' => 2,
                'name' => 'Ward 3',
                'number' => 3,
                'status' => 1,
                'type' => 'Rural',
                'boundry' => 'Dummy boundary data',
                'x_min' => 12.950000,
                'x_max' => 12.955000,
                'y_min' => 77.570000,
                'y_max' => 77.575000
            ]
        ];

        foreach ($wards as $ward) {
            Ward::create($ward);
        }
    }
}