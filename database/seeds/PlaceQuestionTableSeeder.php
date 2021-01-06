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
        // $file = new SplFileObject('database/csvs/place_questions.csv');
        // $file->setFlags(
        //     \SplFileObject::READ_CSV | 
        //     \SplFileObject::READ_AHEAD | 
        //     \SplFileObject::SKIP_EMPTY | 
        //     \SplFileObject::DROP_NEW_LINE
        // );
        $now = Carbon::now();
        $list = [];
        
        // foreach( $file as $line ){
        //     $positionNum = mb_convert_encoding((int)$line[0], 'UTF-8', 'SJIS');
        //     $cardName = mb_convert_encoding($line[1], 'UTF-8', 'SJIS');
        //     $levelName = mb_convert_encoding($line[2], 'UTF-8', 'SJIS');
        //     $genreName = mb_convert_encoding($line[3], 'UTF-8', 'SJIS');

        //     $place_id = DB::table('places')->where('position_num', $positionNum)->first()->id;
        //     $card_id = DB::table('cards')->where('name', $cardName)->first()->id;
        //     $level_id = DB::table('levels')->where('name', $levelName)->first()->id;
        //     $genre_id = DB::table('genres')->where('name', $genreName)->first()->id;

        //     $list[] = [
        //         'place_id' => $place_id, 
        //         'card_id' => $card_id,
        //         'level_id' => $level_id,
        //         'genre_id' => $genre_id,
        //         'created_at' => $now, 
        //         'updated_at' => $now,
        //     ];
        // }

        $cards = DB::table('cards')->get();
        foreach( $cards as $card ) {
            for( $i = 0; $i < 25; $i++ ) {
                if( $i == 12 ) {
                    $level_id = DB::table('levels')->where('name', 'TEST')->first()->id;
                    $genre_id = DB::table('genres')->where('name', 'TEST')->first()->id;
                } else {
                    $level_id = DB::table('levels')->where('name', '共通')->first()->id;
                    $genre_id = DB::table('genres')->where('name', '学校/全体')->first()->id;
                }
                
                $place_id = DB::table('places')->where('position_num', $i)->first()->id;
                $list[] = [
                    'place_id' => $place_id, 
                    'card_id' => $card->id,
                    'level_id' => $level_id,
                    'genre_id' => $genre_id,
                    'created_at' => $now, 
                    'updated_at' => $now,
                ];
            }
        }

        DB::table('place_questions')->insert($list);
    }
}
