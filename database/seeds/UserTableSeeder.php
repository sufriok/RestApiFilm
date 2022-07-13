<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for($i = 1; $i <= 2; $i++){
            DB::table('users')->insert([
                'name' => 'admin'.$i,
                'email' => 'admin'.$i.'@test.com',
                'password' => Hash::make('password'),
                'isAdmin' => true,
            ]);
        }

        for($i = 1; $i <= 2; $i++){
            DB::table('users')->insert([
                'name' => 'user'.$i,
                'email' => 'user'.$i.'@test.com',
                'password' => Hash::make('password'),
                'isAdmin' => false,
            ]);
        }

        // for($i = 1; $i <= 10; $i++){
        //     DB::table('users')->insert([
        //         'name' => Str::random(10),
        //         'email' => Str::random(10).'@test.com',
        //         'password' => Hash::make('password'),
        //     ]);
        // }
    }
}
