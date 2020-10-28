<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class ChoicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $texts = 
        [
            'TEST - ANSWER1', 'TEST - ANSWER2', 'TEST - ANSWER3', 
            'Q1 - ANSWER1',
            'Q2 - ANSWER1',
            'Q3 - ANSWER1', 'Q3 - ANSWER2',
            'Q4 - ANSWER1', 'Q4 - ANSWER2', 'Q4 - ANSWER3', 'Q4 - ANSWER4', 'Q4 - ANSWER5', 'Q4 - ANSWER6',
            'Q5 - ANSWER1', 
            'Q6 - ANSWER1', 
            '...'
        ];
        $is_corrects = 
        [
            true, true, true,
            true,
            true,
            true, false,
            false, true, false, false, false, true,
            true, 
            true, 
            true
        ];
        $questions = 
        [
            'TEST', 'TEST', 'TEST', 
            'Q1',
            'Q2',
            'Q3', 'Q3',
            'Q4', 'Q4', 'Q4', 'Q4', 'Q4', 'Q4',
            'Q5', 
            'Q6', 
            '...'
        ];

        for( $i = 0; $i < count($texts); $i++ ){
            $question_id = DB::table('questions')->where('text', $questions[$i])->first()->id;
            DB::table('choices')->insert([
                'text' => $texts[$i],
                'is_correct' => $is_corrects[$i],
                'question_id' => $question_id,
                'created_at' => $now, 
                'updated_at' => $now,
            ]);
        }
    }
}
