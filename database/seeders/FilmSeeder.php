<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Film;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFilePath = database_path("data/IMDB-Movie-Data.csv");
//        if(!file_exists(database_path("data/IMDB-Movie-Data.csv"))
//        || !is_readable(database_path("data/IMDB-Movie-Data.csv")))
//            return;
        if(!file_exists($csvFilePath)
        || !is_readable($csvFilePath))
        {
            return;
        }

//        $csvFile = fopen(database_path("data/IMDB-Movie-Data.csv"), "r");

        $header = null;
        if(($handle = fopen($csvFilePath, "r")) !== false) {
            while (($row = fgetcsv($handle, 1000, ",")) !== false) {
                if(!$header) {
                    $header = $row;
                }
                else {
                    Film::create([
                        'title' => $row[1],
                        'genres' => isset($row[2]) ? explode(",", $row[2]) : null,
                        'description' => $row[3],
                        'director' => $row[4],
                        'actors' => isset($row[5]) ? explode(",", $row[5]) : null,
                        'year' => $row[6],
                        'runtime' => $row[7],
                        'rating' => $row[8],
                    ]);
                }
            }
            fclose($handle);
        }
    }
}
