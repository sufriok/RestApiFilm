<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FilmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 2; $i++){
            DB::table('films')->insert([
                'judul' => 'film tayang'.$i,
                'video' => 'filmTayang'.$i.'.mp4', 
                'deskripsi' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
                'status' => "tayang",
            ]);
        }

        for($i = 1; $i <= 2; $i++){
            DB::table('films')->insert([
                'judul' => 'film coming soon'.$i,
                'video' => 'filmComingSoon'.$i.'.mp4', 
                'deskripsi' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
                'status' => "coming soon",
            ]);
        }
    }
}
