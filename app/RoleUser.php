<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RoleUser
 *
 * @property integer $user_id
 * @property integer $role_id
 * @method static \Illuminate\Database\Query\Builder|\App\RoleUser whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RoleUser whereRoleId($value)
 * @mixin \Eloquent
 */
class RoleUser extends Model
{
    protected $table='role_user';
    //
}
