<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Faker::create();
        $faker = Faker::create();
        for($i=1; $i<10; $i++){

            $admin = new Admin;
            $admin->firstname = $faker->firstname;
            $admin->lastname = $faker->lastname;
            $admin->email = $faker->email;
            $admin->gender = "M";
            $admin->country = $faker->country;
            $admin->password = "123";
            $admin->image = $faker->image;
            
            $admin->save();
        }
    }
}
