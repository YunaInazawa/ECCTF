<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $names = ['admin', 'hoge'];
        $emails = ['admin@gmail.com', 'hoge@gmail.com'];
        $nums = ['2170000', '2170001'];
        $passwords = ['adminadmin', 'password'];
        $is_admins = [true, false];
        $courses = ['...', 'IE3A'];
        for( $i = 0; $i < count($names); $i++ ){
            $course_id = DB::table('courses')->where('name', $courses[$i])->first()->id;
            DB::table('users')->insert([
                'name' => $names[$i],
                'email' => $emails[$i],
                'student_num' => $nums[$i],
                'password' => Hash::make($passwords[$i]),
                'is_admin' => $is_admins[$i],
                'course_id' => $course_id,
                'created_at' => $now, 
                'updated_at' => $now,
            ]);
        }
    }
}
