<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * @package App\Requests
 *
 * @property string $name
 * @property string $email
 * @property int $role_id
 * @property string $password
 * @property int $ts_register
 * @property int $ts_update
 *
 * @property Role $role
 * @property Courses[] $courses
 * @property Factors[] $factors
 */

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public $timestamps = false;

    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
        'is_active',
        'ts_register',
        'ts_update',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Set the Password .
     *
     * @param  string  $password
     * @return string
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Get role by relation.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get course by relation.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courses()
    {
        $this->hasMany(Course::class);
    }

    /**
     * Get factor by relation.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function factors()
    {
        return $this->hasMany(Factor::class);
    }

}
