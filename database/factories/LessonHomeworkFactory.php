<?php

namespace Database\Factories;

use App\Models\CourseLesson;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class LessonHomeworkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'body' => $this->faker->text($maxNbChars = 300),
            'is_active'=>rand(0,1),
            'lesson_id' => CourseLesson::select('id')->inRandomOrder()->first()->id,
            'ts_register'=>Carbon::now()->timestamp
        ];
    }
}
