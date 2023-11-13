<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VideoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //add tags and video_tags seeders.

        DB::table('series')->insert([[
            'series_name' => 'Weekly Video',
            'category_id' => '3',
        ], [
            'series_name' => 'Mini Messages',
            'category_id' => '3',
        ], [
            'series_name' => 'Teens 5775-5779',
            'category_id' => '6',
        ], [
            'series_name' => 'Teens 5780',
            'category_id' => '6',
        ], [
            'series_name' => '5782 videos with Russian narration',
            'category_id' => '7',
        ], [
            'series_name' => '5781 videos with Russian narration',
            'category_id' => '7',
        ]]);

        DB::table('courses')->insert([[
            'course_name' => 'Paradigm Shift',
            'category_id' => '2',
        ], [
            'course_name' => 'Rivka\'s Tent',
            'category_id' => '4',
        ], [
            'course_name' => 'Think Jewish',
            'category_id' => '5',
        ], [
            'course_name' => 'Jewish Love Secrets',
            'category_id' => '6',
        ]]);

        DB::table('categories')->insert([[
            'category_name' => 'All',
        ], [
            'category_name' => 'Flagship',
        ], [
            'category_name' => 'Weekly',
        ], [
            'category_name' => 'RCS',
        ], [
            'category_name' => 'SSS',
        ], [
            'category_name' => 'Teens',
        ], [
            'category_name' => 'VikiTora',
        ]]);


        DB::table('videos')->insert([[
            'title' => 'Paradigm Shift: Lesson 2 - Clip 2',
            'video_url' => 'https://www.youtube.com/watch?v=Vl2H3Wc8a6c',
            'description' => 'ut! Impedit sit sunt quaerat, odit,
            tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit,',
            'category_id' => 1,
            'class_number' => '?',
            'series_id' => 1,
            'course_id' => null,
        ], [
            'title' => 'Lessons from a Thief',
            'video_url' => 'https://www.youtube.com/watch?v=8VXf1S3-LwE',
            'description' => 'description b',
            'category_id' => 2,
            'class_number' => 16,
            'course_id' => 1,
            'series_id' => null,
        ], [
            'title' => 'How Can Something Be Perfectly Imperfect?',
            'video_url' => 'https://www.torahcafe.com/jewishvideo/menus-with-meaning-video_d04b37eaf.html',
            'description' => 'description c',
            'category_id' => 3,
            'class_number' => 3,
            'course_id' => 2,
            'series_id' => null,
        ], [
            'title' => 'Squirrel Heaven',
            'video_url' => 'https://app.box.com/s/1af4bnt7x4s9q4hnxfj5de4vnlfo42hp/file/603441302163',
            'description' => 'description d',
            'category_id' => 4,
            'class_number' => 'Lesson 21',
            'series_id' => 2,
            'course_id' => null,
        ]]);
    }
}
