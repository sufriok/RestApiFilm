<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FavoritTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('favorits')->truncate();

        DB::table('favorits')->insert([
            [
                'user_id' => '1',
                'film_id' => '1',
            ],
            [
                'user_id' => '1',
                'film_id' => '2',
            ],
            [
                'user_id' => '2',
                'film_id' => '1',
            ],
            [
                'user_id' => '2',
                'film_id' => '2',
            ],
            
        ]);
    }
}
