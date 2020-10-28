<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $nums = 
        [
            0, 1, 2, 3, 4, 5, 6, 7, 8, 
            0, 1, 2, 3, 4, 5, 6, 7, 8
        ];
        $codes = 
        [
            'A000000000', 'B000000000', 'C000000000', 'D000000000', 'E000000000', 'F000000000', 'G000000000', 'H000000000', 'I000000000', 
            'A000000001', 'B000000001', 'C000000001', 'D000000001', 'E000000001', 'F000000001', 'G000000001', 'H000000001', 'I000000001'
        ];
        $names = 
        [
            '1301', '1302', '1303', '2301', '2302', '2303', '3201', '3202', '3301', 
            '1301', '1302', '1303', '2301', '2302', '2303', '3201', '3202', '3301'
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

        for( $i = 0; $i < count($nums); $i++ ){
            $card_id = DB::table('cards')->where('name', $cards[$i])->first()->id;
            $level_id = DB::table('levels')->where('name', $levels[$i])->first()->id;
            $genre_id = DB::table('genres')->where('name', $genres[$i])->first()->id;
            DB::table('places')->insert([
                'position_num' => $nums[$i],
                'position_code' => $codes[$i], 
                'room_name' => $names[$i],
                'card_id' => $card_id,
                'level_id' => $level_id,
                'genre_id' => $genre_id,
                'created_at' => $now, 
                'updated_at' => $now,
            ]);
        }
    }
}
