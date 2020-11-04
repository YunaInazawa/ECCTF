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
        $rooms = 
        [
            '1301', '1302', '1303', '1304', '1305', 
            '1306', '1307', '1308', '1309', '1401', 
            '2301', '2302', '2303', '2501', '2502', 
            '2503', '2504', '2505', '3201', '3202', 
            '3301', '3302', '3701', '3702', '3703'
        ];

        for( $i = 0; $i < count($rooms); $i++ ){
            DB::table('places')->insert([
                'position_num' => $i,
                'position_code' => strtoupper(substr(base_convert(md5(uniqid()), 16, 36), 0, 10)), 
                'room_name' => $rooms[$i],
                'created_at' => $now, 
                'updated_at' => $now,
            ]);
        }
    }
}
