<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([RoleSeeder::class]);
        $this->call([UserSeeder::class]);
        $this->call([CourseSeeder::class]);
        $this->call([CourseLessonSeeder::class]);
        $this->call([LessonHomeworkSeeder::class]);
        $this->call([FactorSeeder::class]);
    }
}
