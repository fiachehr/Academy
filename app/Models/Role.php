<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package App\Requests
 *
 * @property string $title
 * @property int $ts_register
 * @property int $ts_update
 *
 * @property Permissions[] $permissions
 */

class Role extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['title', 'ts_register', 'ts_update'];
    protected $hidden = ['permissions'];

    /**
     * Get permissions by relation.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permissions()
    {
        return $this->hasMany(RolePermission::class);
    }

}
