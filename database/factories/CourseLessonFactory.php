<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Course;
use Illuminate\Support\Carbon;

class CourseLessonFactory extends Factory
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
            'course_id' => Course::select('id')->inRandomOrder()->first()->id,
            'ts_register'=>Carbon::now()->timestamp
        ];
    }
}
