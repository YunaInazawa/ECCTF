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
        $file = new SplFileObject('database/csvs/places.csv');
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
            $roomName = mb_convert_encoding($line[1], 'UTF-8', 'SJIS');
            $positionCode = mb_convert_encoding($line[2], 'UTF-8', 'SJIS');

            $list[] = [
                'position_num' => $positionNum,
                'position_code' => $positionCode, 
                'room_name' => $roomName,
                'created_at' => $now, 
                'updated_at' => $now,
            ];
        }

        DB::table('places')->insert($list);
    }
}
