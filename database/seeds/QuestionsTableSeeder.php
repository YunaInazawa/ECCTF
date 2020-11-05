<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        // $texts = ['TEST', 'Q1', 'Q2', 'Q3', 'Q4', 'Q5', 'Q6', '...'];
        // $types = ['択一クイズ', '穴抜けコード', '一問一答', '二択クイズ', '多答クイズ', '穴抜けコード', '一問一答', '択一クイズ'];
        // $levels = ['TEST', '上級', '上級', '共通', '共通', '下級', '下級', '共通'];
        // $genres = ['TEST', '勉学/プログラミング', '勉学/国家試験', '学校/全体', '学校/先生', '勉学/プログラミング', '勉学/国家試験', '学校/生徒'];

        // for( $i = 0; $i < count($texts); $i++ ){
        //     $type_id = DB::table('types')->where('name', $types[$i])->first()->id;
        //     $level_id = DB::table('levels')->where('name', $levels[$i])->first()->id;
        //     $genre_id = DB::table('genres')->where('name', $genres[$i])->first()->id;
        //     DB::table('questions')->insert([
        //         'text' => $texts[$i],
        //         'type_id' => $type_id,
        //         'level_id' => $level_id,
        //         'genre_id' => $genre_id,
        //         'created_at' => $now, 
        //         'updated_at' => $now,
        //     ]);
        // }

        // テストデータ
        $type_id = DB::table('types')->where('name', '択一クイズ')->first()->id;
        $level_id = DB::table('levels')->where('name', 'TEST')->first()->id;
        $genre_id = DB::table('genres')->where('name', 'TEST')->first()->id;
        DB::table('questions')->insert([
            'text' => 'Q.TEST : TEXT',
            'type_id' => $type_id,
            'level_id' => $level_id,
            'genre_id' => $genre_id,
            'created_at' => $now, 
            'updated_at' => $now,
        ]);

        $genres = ['学校/全体', '学校/先生', '学校/生徒', '勉学/PC基礎', '勉学/国家試験', '勉学/プログラミング'];
        $levels = ['共通', '上級', '下級'];
        $types = ['択一クイズ', '二択クイズ', '多答クイズ', '穴抜けコード', '一問一答'];

        $count = 1;
        for( $z = 0; $z < 3; $z++ ){
            for( $i = 0; $i < count($genres); $i++ ){
                for( $j = 0; $j < count($levels); $j++ ){
                    $type_id = DB::table('types')->where('name', $types[mt_rand(0, 4)])->first()->id;
                    $level_id = DB::table('levels')->where('name', $levels[$j])->first()->id;
                    $genre_id = DB::table('genres')->where('name', $genres[$i])->first()->id;
                    DB::table('questions')->insert([
                        'text' => 'Q.' . ($count++) . ' : TEXT',
                        'type_id' => $type_id,
                        'level_id' => $level_id,
                        'genre_id' => $genre_id,
                        'created_at' => $now, 
                        'updated_at' => $now,
                    ]);
                }
            }
        }
    }
}
