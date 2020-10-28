<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $names = ['共通', '上級生用', '下級生用'];

        foreach( $names as $name ){
            DB::table('levels')->insert([
                'name' => $name,
                'created_at' => $now, 
                'updated_at' => $now,
            ]);
        }
    }
}
