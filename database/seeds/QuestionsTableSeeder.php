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
        $texts = ['TEST', 'Q1', 'Q2', 'Q3', 'Q4', 'Q5', 'Q6', '...'];
        $types = ['択一クイズ', '穴抜けコード', '一問一答', '二択クイズ', '多答クイズ', '穴抜けコード', '一問一答', '択一クイズ'];
        $levels = ['TEST', '上級', '上級', '共通', '共通', '下級', '下級', '共通'];
        $genres = ['TEST', '勉学/プログラミング', '勉学/国家試験', '学校/全体', '学校/先生', '勉学/プログラミング', '勉学/国家試験', '学校/生徒'];
        
        for( $i = 0; $i < count($texts); $i++ ){
            $type_id = DB::table('types')->where('name', $types[$i])->first()->id;
            $level_id = DB::table('levels')->where('name', $levels[$i])->first()->id;
            $genre_id = DB::table('genres')->where('name', $genres[$i])->first()->id;
            DB::table('questions')->insert([
                'text' => $texts[$i],
                'type_id' => $type_id,
                'level_id' => $level_id,
                'genre_id' => $genre_id,
                'created_at' => $now, 
                'updated_at' => $now,
            ]);
        }
    }
}
