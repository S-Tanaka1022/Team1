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
            ['user_id' => 1, 'region_code' => '130000'],
            ['user_id' => 1, 'region_code' => '014100'],
            ['user_id' => 1, 'region_code' => '200000'],
            ['user_id' => 1, 'region_code' => '210000'],
            ['user_id' => 1, 'region_code' => '270000'],
            ['user_id' => 2, 'region_code' => '120000'],
            ['user_id' => 2, 'region_code' => '300000'],
            ['user_id' => 2, 'region_code' => '360000'],
            ['user_id' => 2, 'region_code' => '400000'],
            ['user_id' => 2, 'region_code' => '471000'],
            ['user_id' => 2, 'region_code' => '130000'],
        ]);
    }
}
