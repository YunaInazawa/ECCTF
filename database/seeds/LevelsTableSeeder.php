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
        $names = ['TEST', '共通', '上級', '下級'];

        foreach( $names as $name ){
            DB::table('levels')->insert([
                'name' => $name,
                'created_at' => $now, 
                'updated_at' => $now,
            ]);
        }
    }
}
