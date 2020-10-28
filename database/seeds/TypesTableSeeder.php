<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $names = [];

        foreach( $names as $name ){
            DB::table('elements')->insert([
                'name' => $name,
                'created_at' => $now, 
                'updated_at' => $now,
            ]);
        }
    }
}
