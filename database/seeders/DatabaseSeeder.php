<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('roles')->insert([
            'role_name' => 'admin',
        ], [
            'role_name' => 'view all',
        ], [
            'role_name' => 'advanced user',
        ], [
            'role_name' => 'reading permission',
        ], [
            'role_name' => 'videos permission',
        ], [
            'role_name' => 'library permission',
        ]);
        DB::table('org_books')->insert([
            'org_book_name' => 'beyond right',
        ]);
        DB::table('users')->insert([
            'name' => 'mushkie',
            'email' => 'mlent@test.com',
            'password' => Hash::make('5782'),
            'role_id' => 1,
        ]);
        DB::table('locations')->insert([
            'location_a' => 'Meforshim',
            'location_b' => 'Rashi',
            'location_c' => 'Shemos',
            'location_d' => '1-2',
        ], [
            'location_a' => 'Chumash',
            'location_b' => 'Bereishis',
            'location_c' => 'perek A',
            'location_d' => '1-2',
        ], [
            'location_a' => 'Chumash',
            'location_b' => 'Bereishis',
            'location_c' => 'perek B',
            'location_d' => '1-2',
        ], [
            'location_a' => 'Chumash',
            'location_b' => 'Shemos',
            'location_c' => 'perek A',
            'location_d' => '1-2',
        ]);
        DB::table('readings')->insert([[
            'location_id' => 1,
            'reading_text' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
            molestiae quas vel sint commodi repudiandae conse',
            'translation' => 'ut! Impedit sit sunt quaerat, odit,
            tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit,',
            'english_location_full' => 'eng loc full a',
            'hebrew_location_full' => 'הומש, בּראשׂית, פּרק ב, א-ב',
            'org_book_id' => 1,
            'org_book_page' => '34',
        ], [
            'location_id' => 2,
            'reading_text' => 'reading text b',
            'translation' => 'translation b',
            'english_location_full' => 'eng loc full b',
            'hebrew_location_full' => 'הומש, בּראשׂית, פּרק ב, ',
            'org_book_id' => 1,
            'org_book_page' => '2',
        ], [
            'location_id' => 3,
            'reading_text' => 'reading text c',
            'translation' => 'translation c',
            'english_location_full' => 'eng loc full c',
            'hebrew_location_full' => 'הומש, בּראשׂית, פּרק ב, ב',
            'org_book_id' => 1,
            'org_book_page' => '3',
        ], [
            'location_id' => 4,
            'reading_text' => 'reading text d',
            'translation' => 'translation d',
            'english_location_full' => 'eng loc full d',
            'hebrew_location_full' => 'הומש, בּראשׂית, פּרק ב, א-',
            'org_book_id' => 1,
            'org_book_page' => '4',
        ]]);
    }
}
