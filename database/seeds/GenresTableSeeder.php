<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $names = ['学校/全体', '学校/先生', '学校/生徒', '勉学/PC基礎', '勉学/国家試験', '勉学/プログラミング'];

        foreach( $names as $name ){
            DB::table('genres')->insert([
                'name' => $name,
                'created_at' => $now, 
                'updated_at' => $now,
            ]);
        }
    }
}
