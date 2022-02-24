<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseLesson;
use Illuminate\Database\Seeder;

class CourseLessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = Course::all();
        foreach ($courses as $value) {
            $lessonCount = rand (7,23);
            CourseLesson::factory()->count($lessonCount)->create(['course_id'=>$value->id]);
        }
    }
}
