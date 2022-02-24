<?php

namespace Database\Seeders;


use App\Models\CourseLesson;
use App\Models\LessonHomework;
use Illuminate\Database\Seeder;

class LessonHomeworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lessons = CourseLesson::all();
        foreach ($lessons as $value) {
            $homeWorkCount = rand (1,3);
            LessonHomework::factory()->count($homeWorkCount)->create(['lesson_id'=>$value->id]);
        }
    }
}
