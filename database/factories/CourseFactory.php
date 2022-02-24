<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Carbon;

class CourseFactory extends Factory
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
            'description' => $this->faker->text($maxNbChars = 300),
            'prise'=> rand(100,1000),
            'is_finished'=>rand(0,1),
            'is_active'=>rand(0,1),
            'ts_expire'=> Carbon::yesterday()->addDay(rand(-50, 365))->timestamp,
            'user_id' => User::select('id')->whereNotIn('role_id', [4])->inRandomOrder()->first()->id,
            'ts_register'=>Carbon::now()->timestamp
        ];
    }
}
