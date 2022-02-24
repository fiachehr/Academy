<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Course
 * @package App\Requests
 *
 * @property int $user_id
 * @property string $title
 * @property text $description
 * @property int $prise
 * @property int $is_finished
 * @property Boolean $is_active
 * @property Boolean $ts_expire
 * @property int $ts_register
 * @property int $ts_update
 *
 * @property User $user
 * @property Lessons[] $lessons
 * @property Factors[] $factors
 */


class Course extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['user_id', 'title', 'description', 'prise', 'is_finished', 'is_active', 'ts_expire', 'ts_register', 'ts_update'];

    /**
     * Get user by relation.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get lessons by relation.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lessons()
    {
        return $this->hasMany(CourseLesson::class);
    }

    /**
     * Get factors by relation.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function factors()
    {
        return $this->hasMany(Factor::class);
    }
}
