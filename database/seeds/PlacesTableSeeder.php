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
            0, 1, 2, 3, 4, 5, 6, 7, 8
        ];
        $codes = 
        [
            'A000000000', 'B000000000', 'C000000000', 'D000000000', 'E000000000', 'F000000000', 'G000000000', 'H000000000', 'I000000000'
        ];
        $names = 
        [
            '1301', '1302', '1303', '2301', '2302', '2303', '3201', '3202', '3301'
        ];

        for( $i = 0; $i < count($nums); $i++ ){
            DB::table('places')->insert([
                'position_num' => $nums[$i],
                'position_code' => $codes[$i], 
                'room_name' => $names[$i],
                'created_at' => $now, 
                'updated_at' => $now,
            ]);
        }
    }
}
