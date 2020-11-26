<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class PlaceQuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = new SplFileObject('database/csvs/place_questions.csv');
        $file->setFlags(
            \SplFileObject::READ_CSV | 
            \SplFileObject::READ_AHEAD | 
            \SplFileObject::SKIP_EMPTY | 
            \SplFileObject::DROP_NEW_LINE
        );
        $now = Carbon::now();
        $list = [];
        
        foreach( $file as $line ){
            $positionNum = mb_convert_encoding((int)$line[0], 'UTF-8', 'SJIS');
            $cardName = mb_convert_encoding($line[1], 'UTF-8', 'SJIS');
            $levelName = mb_convert_encoding($line[2], 'UTF-8', 'SJIS');
            $genreName = mb_convert_encoding($line[3], 'UTF-8', 'SJIS');

            $place_id = DB::table('places')->where('position_num', $positionNum)->first()->id;
            $card_id = DB::table('cards')->where('name', $cardName)->first()->id;
            $level_id = DB::table('levels')->where('name', $levelName)->first()->id;
            $genre_id = DB::table('genres')->where('name', $genreName)->first()->id;

            $list[] = [
                'place_id' => $place_id, 
                'card_id' => $card_id,
                'level_id' => $level_id,
                'genre_id' => $genre_id,
                'created_at' => $now, 
                'updated_at' => $now,
            ];
        }

        DB::table('place_questions')->insert($list);
    }
}
