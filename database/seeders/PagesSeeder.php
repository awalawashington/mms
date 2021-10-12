<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            'name' => 'Login'
        ]);
        DB::table('pages')->insert([
            'name' => 'Register'
        ]);
        DB::table('pages')->insert([
            'name' => 'Confirm Account'
        ]);
        DB::table('pages')->insert([
            'name' => 'Forgot Password'
        ]);
        DB::table('pages')->insert([
            'name' => 'Reset Password'
        ]);
        DB::table('pages')->insert([
            'name' => 'Home'
        ]);
        DB::table('pages')->insert([
            'name' => 'Profile'
        ]);
        DB::table('pages')->insert([
            'name' => 'Search Results'
        ]);
        DB::table('pages')->insert([
            'name' => 'Photo'
        ]);
        DB::table('pages')->insert([
            'name' => 'Dashboard'
        ]);
        DB::table('pages')->insert([
            'name' => 'Users'
        ]);
    }
}
