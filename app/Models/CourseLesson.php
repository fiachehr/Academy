<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Class CourseLesson
 * @package App\Requests
 *
 * @property int $course_id
 * @property string $title
 * @property text $body
 * @property Boolean $is_active
 * @property int $ts_register
 * @property int $ts_update
 *
 * @property Course $course
 * @property Homeworks[] $homeworks
 */

class CourseLesson extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['course_id', 'title', 'body', 'is_active', 'ts_register', 'ts_update'];

    /**
     * Get course by relation.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get homeworks by relation.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function homeworks()
    {
        return $this->hasMany(LessonHomework::class);
    }
}
