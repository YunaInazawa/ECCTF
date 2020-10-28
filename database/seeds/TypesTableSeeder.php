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
        $names = ['択一クイズ', '二択クイズ', '多答クイズ', '穴抜けコード', '一問一答'];

        foreach( $names as $name ){
            DB::table('types')->insert([
                'name' => $name,
                'created_at' => $now, 
                'updated_at' => $now,
            ]);
        }
    }
}
