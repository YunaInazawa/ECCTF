<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GenresTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(LevelsTableSeeder::class);
        $this->call(CardsTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(GiftsTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(ChoicesTableSeeder::class);
        $this->call(PlacesTableSeeder::class);
        $this->call(PlaceQuestionTableSeeder::class);
    }
}
