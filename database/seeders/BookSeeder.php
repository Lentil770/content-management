<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            'author' => 'author 1',
            'title' => 'book title 1',
            'subtitle' => 'test test subrit;e',
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('books')->insert([
            'author' => 'author 1',
            'title' => 'book title 2',
            'subtitle' => 'test test subtitle',
            'category_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('books')->insert([
            'author' => 'author 2',
            'title' => 'book title 3',
            'subtitle' => 'lore ipsum',
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('books')->insert([
            'author' => 'author 2',
            'title' => 'book title 4',
            'subtitle' => '',
            'category_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('books')->insert([
            'author' => 'author 2',
            'title' => 'book title 5',
            'subtitle' => '',
            'category_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('books')->insert([
            'author' => 'author 2',
            'title' => 'book title 6',
            'subtitle' => '',
            'category_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('books')->insert([
            'author' => 'author 3',

            'title' => 'book title 7',
            'subtitle' => '',
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
