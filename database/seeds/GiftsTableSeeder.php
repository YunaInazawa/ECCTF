<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class GiftsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = new SplFileObject('database/csvs/gifts.csv');
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

            $list[] = [
                'name' => $name,
                'created_at' => $now, 
                'updated_at' => $now,
            ];
        }

        DB::table('gifts')->insert($list);
    }
}
