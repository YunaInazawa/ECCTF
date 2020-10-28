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
        $now = Carbon::now();
        $names = ['景品１', '景品２', '景品３', '景品４', '景品５', '景品６', '...'];

        foreach( $names as $name ){
            DB::table('gifts')->insert([
                'name' => $name,
                'created_at' => $now, 
                'updated_at' => $now,
            ]);
        }
    }
}
