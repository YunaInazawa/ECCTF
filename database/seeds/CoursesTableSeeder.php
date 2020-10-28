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

        foreach( $names as $name ){
            DB::table('courses')->insert([
                'name' => $name,
                'created_at' => $now, 
                'updated_at' => $now,
            ]);
        }
    }
}
