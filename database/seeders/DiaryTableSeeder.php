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
                'content' => 'The purple elephants danced gracefully on the moonlit marshmallow clouds.',
                'image_url' => NULL,
                'small_image_url' => NULL,
                'local_image_path' => 'storage/images/diary_images/default/no_image.png',
                'local_small_image_path' => 'storage/images/diary_images/default/no_image.png',
                'original_image_name' => 'no_image.png',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'content' => 'Sparkling unicorns sipped cosmic lemonade from invisible goblets.',
                'image_url' => NULL,
                'small_image_url' => NULL,
                'local_image_path' => NULL,
                'local_small_image_path' => NULL,
                'original_image_name' => NULL,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'content' => 'The polka-dotted giraffe serenaded the giggling broccoli with a ukulele.',
                'image_url' => NULL,
                'small_image_url' => NULL,
                'local_image_path' => NULL,
                'local_small_image_path' => NULL,
                'original_image_name' => NULL,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'content' => 'Plant enthusiasts thrive in the nurturing embrace of nature, finding joy and tranquility amidst their verdant companions.',
                'image_url' => NULL,
                'small_image_url' => NULL,
                'local_image_path' => 'storage/images/diary_images/default/botanical_1.jpg',
                'local_small_image_path' => 'storage/images/diary_images/default/botanical_1.jpg',
                'original_image_name' => 'botanical_1.jpg',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'content' => 'Plant lovers find solace, beauty, and a connection to nature through their beloved leafy companions.',
                'image_url' => NULL,
                'small_image_url' => NULL,
                'local_image_path' => 'storage/images/diary_images/default/botanical_2.jpg',
                'local_small_image_path' => 'storage/images/diary_images/default/botanical_2.jpg',
                'original_image_name' => 'botanical_2.jpg',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'content' => 'Plant enthusiasts cultivate a deep passion for the botanical world, finding fulfillment and harmony in the growth and vitality of their cherished green companions.',
                'image_url' => NULL,
                'small_image_url' => NULL,
                'local_image_path' => 'storage/images/diary_images/default/botanical_3.jpg',
                'local_small_image_path' => 'storage/images/diary_images/default/botanical_3.jpg',
                'original_image_name' => 'botanical_3.jpg',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        ];

        DB::table('diary')->insert($diaries);
    }
}
