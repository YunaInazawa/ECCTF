<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = new SplFileObject('database/csvs/courses.csv');
        $file->setFlags(
            \SplFileObject::READ_CSV | 
            \SplFileObject::READ_AHEAD | 
            \SplFileObject::SKIP_EMPTY | 
            \SplFileObject::DROP_NEW_LINE
        );
        $now = Carbon::now();
        $list = [];
        
        foreach( $file as $line ){
            $name = mb_convert_encoding($line[0], 'UTF-8', 'SJIS');
            $cardName = mb_convert_encoding($line[1], 'UTF-8', 'SJIS');

            $card_id = DB::table('cards')->where('name', $cardName)->first()->id;
            
            $list[] = [
                'name' => $name,
                'card_id' => $card_id,
                'created_at' => $now, 
                'updated_at' => $now,
            ];
        }

        DB::table('courses')->insert($list);
    }
}
