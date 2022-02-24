<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RolePermission
 * @package App\Requests
 *
 * @property int $role_id
 * @property char $module
 * @property char $type
 */

class RolePermission extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['role_id','module','type'];
}
