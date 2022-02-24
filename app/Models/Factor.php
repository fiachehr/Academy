<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Factor
 * @package App\Requests
 *
 * @property string $number
 * @property int $user_id
 * @property int $course_id
 * @property int $prise
 * @property Boolean $is_paid
 * @property int $ts_register
 * @property int $referenceID
 *
 * @property User $user
 * @property Course $course
 */

class Factor extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['number', 'user_id', 'course_id', 'prise', 'is_paid', 'ts_register', 'referenceID'];

    /**
     * Get course by relation.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get user by relation.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
