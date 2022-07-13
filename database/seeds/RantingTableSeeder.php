<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RantingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ratings')->truncate();

        DB::table('ratings')->insert([
            [
                'rating' => '2',
                'user_id' => '1',
                'film_id' => '1',
            ],
            [
                'rating' => '5',
                'user_id' => '1',
                'film_id' => '2',
            ],
            [
                'rating' => '5',
                'user_id' => '2',
                'film_id' => '1',
            ],
            [
                'rating' => '3',
                'user_id' => '2',
                'film_id' => '2',
            ],
            
        ]);
    }
}
