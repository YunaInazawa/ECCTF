<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class CardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $names = ['IT上級生用', 'IT下級生用', 'GAME上級生用', 'GAME下級生用', 'その他'];

        foreach( $names as $name ){
            DB::table('cards')->insert([
                'name' => $name,
                'created_at' => $now, 
                'updated_at' => $now,
            ]);
        }
    }
}
