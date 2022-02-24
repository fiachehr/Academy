<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LessonHomework
 * @package App\Requests
 *
 * @property int $lesson_id
 * @property string $title
 * @property text $body
 * @property Boolean $is_active
 * @property int $ts_register
 * @property int $ts_update
 *
 * @property Lesson $lesson
 */

class LessonHomework extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['lesson_id', 'title', 'body', 'is_active', 'ts_register', 'ts_update'];

    /**
     * Get homework by relation.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lesson()
    {
        return $this->belongsTo(CourseLesson::class);
    }
}
