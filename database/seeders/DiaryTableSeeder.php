<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class DiaryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $diaries = [
            [
                'comment' => 'Plant enthusiasts thrive in the nurturing embrace of nature, finding joy and tranquility amidst their verdant companions.',
                'image_name' => 'botanical_1.jpg',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'comment' => 'Plant lovers find solace, beauty, and a connection to nature through their beloved leafy companions.',
                'image_name' => 'botanical_2.jpg',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'comment' => 'Plant enthusiasts cultivate a deep passion for the botanical world, finding fulfillment and harmony in the growth and vitality of their cherished green companions.',
                'image_name' => 'botanical_3.jpg',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        ];

        DB::table('diary')->insert($diaries);
    }
}
