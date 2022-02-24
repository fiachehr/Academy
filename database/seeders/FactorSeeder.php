<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Factor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class FactorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::whereNotIn('role_id',[1])->where('is_active',1)->get();
        foreach ($user as $value) {
            $lessonCount = rand(1, 7);
            $course = Course::select(['id','prise'])->where('is_active',1)->inRandomOrder()->first();
            Factor::factory()->count($lessonCount)->create(
                [
                    'user_id' => $value->id,
                    'course_id' => $course->id,
                    'prise' => ($course->prise + ($course->prise * 0.093)),
                    'is_paid' => rand(0,1),
                    'ts_register'=> Carbon::today()->addDay(rand(-365, 365))->timestamp
                ]
            );
        }
    }
}
