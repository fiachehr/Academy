<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Course;

class FactorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $course = Course::select('id')->inRandomOrder()->first();
        return [
            'number' => Carbon::now()->timestamp . rand(1000, 9999),
            'user_id' => User::select('id')->whereNotIn('role_id', [1])->inRandomOrder()->first()->id,
            'course_id' =>  $course->id,
            'prise'=> $course->prise,
            'is_paid'=> rand(0,1),
            'ts_register'=>Carbon::now()->timestamp,
            'referenceID' => rand(1000000, 9999999)
        ];
    }
}
