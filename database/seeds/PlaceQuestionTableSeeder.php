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

        // テストデータはランダムなので、今は使用していない（本番では決める）
        // $placeNums = 
        // [
        //     0, 1, 2, 3, 4, 5, 6, 7, 8, 
        //     0, 1, 2, 3, 4, 5, 6, 7, 8
        // ];
        // $cards = 
        // [
        //     'IT上級生用', 'IT上級生用', 'IT上級生用', 'IT上級生用', 'IT上級生用', 'IT上級生用', 'IT上級生用', 'IT上級生用', 'IT上級生用', 
        //     'IT下級生用', 'IT下級生用', 'IT下級生用', 'IT下級生用', 'IT下級生用', 'IT下級生用', 'IT下級生用', 'IT下級生用', 'IT下級生用'
        // ];
        // $levels = 
        // [
        //     '上級', '下級', '上級', '共通', 'TEST', '下級', '共通', '上級', '下級', 
        //     '上級', '下級', '上級', '下級', 'TEST', '上級', '共通', '上級', '下級'
        // ];
        // $genres = 
        // [
        //     '勉学/プログラミング', '勉学/PC基礎', '勉学/国家試験', '学校/全体', 'TEST', '勉学/PC基礎', '学校/先生', '勉学/国家試験', '勉学/プログラミング', 
        //     '勉学/プログラミング', '勉学/国家試験', '勉学/国家試験', '勉学/プログラミング', 'TEST', '勉学/PC基礎', '学校/先生', '勉学/国家試験', '勉学/プログラミング'
        // ]; 

        // for( $i = 0; $i < count($placeNums); $i++ ){
        //     $place_id = DB::table('places')->where('position_num', $placeNums[$i])->first()->id;
        //     $card_id = DB::table('cards')->where('name', $cards[$i])->first()->id;
        //     $level_id = DB::table('levels')->where('name', $levels[$i])->first()->id;
        //     $genre_id = DB::table('genres')->where('name', $genres[$i])->first()->id;
        //     DB::table('place_questions')->insert([
        //         'place_id' => $place_id, 
        //         'card_id' => $card_id,
        //         'level_id' => $level_id,
        //         'genre_id' => $genre_id,
        //         'created_at' => $now, 
        //         'updated_at' => $now,
        //     ]);
        // }

        // テストデータ
        $cards = ['IT上級生用', 'IT下級生用', 'GAME上級生用', 'GAME下級生用', 'その他'];
        $levels = ['TEST', '共通', '上級', '下級'];
        $genres = ['TEST', '学校/全体', '学校/先生', '学校/生徒', '勉学/PC基礎', '勉学/国家試験', '勉学/プログラミング'];

        for( $i = 0; $i < 125; $i++ ){
            $card_num = floor($i / 25);
            $place_id = DB::table('places')->where('position_num', ($i % 25))->first()->id;
            $card_id = DB::table('cards')->where('name', $cards[$card_num])->first()->id;
            $level_id = DB::table('levels')->where('name', $levels[($place_id == 13 ? 0 : mt_rand(1, 3))])->first()->id;
            $genre_id = DB::table('genres')->where('name', $genres[($place_id == 13 ? 0 : mt_rand(1, 6))])->first()->id;
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
