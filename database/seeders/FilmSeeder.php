<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('films')->insert([
            [
                'title' => 'Film 1',
                'description' => 'Deskripsi Film 1',
                'release_year' => 2021,
                'rating' => 8.5,
                'duration' => 120,
                'genre_id' => 1,
            ],
        ]);
    }
}
