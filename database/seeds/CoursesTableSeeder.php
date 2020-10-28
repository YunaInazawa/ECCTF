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
        $now = Carbon::now();
        $names = ['IE1A', 'IE2A', 'IE3A', 'IE4A', 'SE1A', 'SE2A', 'SE3A', '...'];
        $cards = ['IT下級生用', 'IT下級生用', 'IT上級生用', 'IT上級生用', 'IT下級生用', 'IT下級生用', 'IT上級生用', 'その他'];

        for( $i = 0; $i < count($names); $i++ ){
            $card_id = DB::table('cards')->where('name', $cards[$i])->first()->id;
            DB::table('courses')->insert([
                'name' => $names[$i],
                'card_id' => $card_id,
                'created_at' => $now, 
                'updated_at' => $now,
            ]);
        }
    }
}
