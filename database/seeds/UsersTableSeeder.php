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
        $file = new SplFileObject('database/csvs/users.csv');
        $file->setFlags(
            \SplFileObject::READ_CSV | 
            \SplFileObject::READ_AHEAD | 
            \SplFileObject::SKIP_EMPTY | 
            \SplFileObject::DROP_NEW_LINE
        );
        $now = Carbon::now();
        $list = [];
        
        foreach( $file as $line ){
            $name = mb_convert_encoding($line[0], 'UTF-8', 'SJIS');
            $email = mb_convert_encoding($line[1], 'UTF-8', 'SJIS');
            $studentNum = mb_convert_encoding($line[2], 'UTF-8', 'SJIS');
            $password = mb_convert_encoding($line[3], 'UTF-8', 'SJIS');
            $isAdmin = mb_convert_encoding($line[4], 'UTF-8', 'SJIS');
            $courseName = mb_convert_encoding($line[5], 'UTF-8', 'SJIS');

            $course_id = DB::table('courses')->where('name', $courseName)->first()->id;
            
            $list[] = [
                'name' => $name,
                'email' => $email,
                'student_num' => $studentNum,
                'password' => Hash::make($password),
                'is_admin' => $isAdmin,
                'course_id' => $course_id,
                'created_at' => $now, 
                'updated_at' => $now,
            ];
        }

        DB::table('users')->insert($list);
    }
}
