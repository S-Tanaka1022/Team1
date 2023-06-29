<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('regions')->insert([
            ['user_id' => 1, 'region_code' => '130000', 'area_code' => '0'],
            ['user_id' => 1, 'region_code' => '014100', 'area_code' => '1'],
            ['user_id' => 1, 'region_code' => '200000', 'area_code' => '0'],
            ['user_id' => 1, 'region_code' => '210000', 'area_code' => '1'],
            ['user_id' => 1, 'region_code' => '270000', 'area_code' => '0'],
            ['user_id' => 2, 'region_code' => '120000', 'area_code' => '0'],
            ['user_id' => 2, 'region_code' => '300000', 'area_code' => '1'],
            ['user_id' => 2, 'region_code' => '360000', 'area_code' => '0'],
            ['user_id' => 2, 'region_code' => '400000', 'area_code' => '1'],
            ['user_id' => 2, 'region_code' => '471000', 'area_code' => '0'],
            ['user_id' => 2, 'region_code' => '130000', 'area_code' => '1'],
        ]);
    }
}
