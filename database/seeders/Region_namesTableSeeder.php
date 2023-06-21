<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Region_namesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('region_names')->insert([
            ['region_code' => '011000', 'region_name' => '北海道宗谷地方'],
            ['region_code' => '012000', 'region_name' => '北海道上川・留萌地方'],
            ['region_code' => '016000', 'region_name' => '北海道石狩・空知・後志地方'],
            ['region_code' => '013000', 'region_name' => '北海道網走・北見・紋別地方'],
            ['region_code' => '014100', 'region_name' => '北海道釧路・根室・十勝地方'],
            ['region_code' => '015000', 'region_name' => '北海道胆振・日高地方'],
            ['region_code' => '017000', 'region_name' => '北海道渡島・檜山地方'],

            ['region_code' => '020000', 'region_name' => '青森県'],
            ['region_code' => '050000', 'region_name' => '秋田県'],
            ['region_code' => '030000', 'region_name' => '岩手県'],
            ['region_code' => '040000', 'region_name' => '宮城県'],
            ['region_code' => '060000', 'region_name' => '山形県'],
            ['region_code' => '070000', 'region_name' => '福島県'],

            ['region_code' => '080000', 'region_name' => '茨城県'],
            ['region_code' => '090000', 'region_name' => '栃木県'],
            ['region_code' => '100000', 'region_name' => '群馬県'],
            ['region_code' => '110000', 'region_name' => '埼玉県'],
            ['region_code' => '130000', 'region_name' => '東京都'],
            ['region_code' => '120000', 'region_name' => '千葉県'],
            ['region_code' => '140000', 'region_name' => '神奈川県'],
            ['region_code' => '200000', 'region_name' => '長野県'],
            ['region_code' => '190000', 'region_name' => '山梨県'],

            ['region_code' => '220000', 'region_name' => '静岡県'],
            ['region_code' => '230000', 'region_name' => '愛知県'],
            ['region_code' => '210000', 'region_name' => '岐阜県'],
            ['region_code' => '240000', 'region_name' => '三重県'],

            ['region_code' => '150000', 'region_name' => '新潟県'],
            ['region_code' => '160000', 'region_name' => '富山県'],
            ['region_code' => '170000', 'region_name' => '石川県'],
            ['region_code' => '180000', 'region_name' => '福井県'],

            ['region_code' => '250000', 'region_name' => '滋賀県'],
            ['region_code' => '260000', 'region_name' => '京都府'],
            ['region_code' => '270000', 'region_name' => '大阪府'],
            ['region_code' => '280000', 'region_name' => '兵庫県'],
            ['region_code' => '290000', 'region_name' => '奈良県'],
            ['region_code' => '300000', 'region_name' => '和歌山県'],

            ['region_code' => '330000', 'region_name' => '岡山県'],
            ['region_code' => '340000', 'region_name' => '広島県'],
            ['region_code' => '320000', 'region_name' => '島根県'],
            ['region_code' => '310000', 'region_name' => '鳥取県'],

            ['region_code' => '360000', 'region_name' => '徳島県'],
            ['region_code' => '370000', 'region_name' => '香川県'],
            ['region_code' => '380000', 'region_name' => '愛媛県'],
            ['region_code' => '390000', 'region_name' => '高知県'],

            ['region_code' => '350000', 'region_name' => '山口県'],
            ['region_code' => '400000', 'region_name' => '福岡県'],
            ['region_code' => '440000', 'region_name' => '大分県'],
            ['region_code' => '420000', 'region_name' => '長崎県'],
            ['region_code' => '410000', 'region_name' => '佐賀県'],
            ['region_code' => '430000', 'region_name' => '熊本県'],
            ['region_code' => '450000', 'region_name' => '宮崎県'],
            ['region_code' => '460100', 'region_name' => '鹿児島県'],

            ['region_code' => '471000', 'region_name' => '沖縄本島地方'],
            ['region_code' => '472000', 'region_name' => '大東島地方'],
            ['region_code' => '473000', 'region_name' => '宮古島地方'],
            ['region_code' => '474000', 'region_name' => '八重山地方']



        ]);
    }
}
