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
        $now = Carbon::now();
        $placeCodes = 
        [
            'A000000000', 'B000000000', 'C000000000', 'D000000000', 'E000000000', 'F000000000', 'G000000000', 'H000000000', 'I000000000', 
            'A000000000', 'B000000000', 'C000000000', 'D000000000', 'E000000000', 'F000000000', 'G000000000', 'H000000000', 'I000000000'
        ];
        $cards = 
        [
            'IT下級生用', 'IT下級生用', 'IT下級生用', 'IT下級生用', 'IT下級生用', 'IT下級生用', 'IT下級生用', 'IT下級生用', 'IT下級生用', 
            'GAME上級生用', 'GAME上級生用', 'GAME上級生用', 'GAME上級生用', 'GAME上級生用', 'GAME上級生用', 'GAME上級生用', 'GAME上級生用', 'GAME上級生用'
        ];
        $levels = 
        [
            '上級', '下級', '上級', '共通', 'TEST', '下級', '共通', '上級', '下級', 
            '上級', '下級', '上級', '下級', 'TEST', '上級', '共通', '上級', '下級'
        ];
        $genres = 
        [
            '勉学/プログラミング', '勉学/PC基礎', '勉学/国家試験', '学校/全体', 'TEST', '勉学/PC基礎', '学校/先生', '勉学/国家試験', '勉学/プログラミング', 
            '勉学/プログラミング', '勉学/国家試験', '勉学/国家試験', '勉学/プログラミング', 'TEST', '勉学/PC基礎', '学校/先生', '勉学/国家試験', '勉学/プログラミング'
        ]; 

        for( $i = 0; $i < count($placeCodes); $i++ ){
            $place_id = DB::table('places')->where('position_code', $placeCodes[$i])->first()->id;
            $card_id = DB::table('cards')->where('name', $cards[$i])->first()->id;
            $level_id = DB::table('levels')->where('name', $levels[$i])->first()->id;
            $genre_id = DB::table('genres')->where('name', $genres[$i])->first()->id;
            DB::table('place_questions')->insert([
                'place_id' => $place_id, 
                'card_id' => $card_id,
                'level_id' => $level_id,
                'genre_id' => $genre_id,
                'created_at' => $now, 
                'updated_at' => $now,
            ]);
        }
    }
}
