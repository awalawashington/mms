<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10000; $i++) { 
            DB::table('users')->insert([
                'name' => Str::random(10). " ". Str::random(10),
                'username' => Str::random(10),
                'email' => Str::random(10).'gmail.com',
                'phone' => Arr::random(array(12345678, 91024656, 98765432)),
                'address' => Str::random(10),
                'nationality' => Arr::random([1,10,20,2,3,4,5,6,56,57,59,78,88,98,28,67,77,87,90]),
                'role' => Arr::random(array(0,1)),
                'dob' => Carbon::now(),
                'height' => rand(1, 3),
                'weight' => rand(30, 200),
                'color' => Arr::random(array('Dark', 'Light', 'Medium')),
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'marital_status' => Arr::random(array('Married', 'Single')),
            ]);
        }
        
            
    }
}
