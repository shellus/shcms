<?php

namespace App;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
/**
 * App\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $api_token
 * @property string $register_ip
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
 * @method static \Illuminate\Database\Query\Builder|\App\User whereApiToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRegisterIp($value)
 * @property integer $avatar_id
 * @property-read \App\File $avatar
 * @property-read mixed $avatar_url
 * @method static \Illuminate\Database\Query\Builder|\App\User whereAvatarId($value)
 * @property-read mixed $role_name
 */
class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'register_ip','api_token',
    ];

    protected $visible = [
        'id', 'name', 'email','api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//    protected $hidden = [
//        'password', 'remember_token',
//    ];


    public function avatar(){
        return $this->belongsTo('App\File');
    }

    public function getAvatarUrlAttribute(){
        if(!$this->avatar){
            return asset('images/no_avatars/1.png');
        }
        return $this -> avatar -> url;
    }
    public function getRoleNameAttribute(){
        if(!$this->roles){
            return '无用户组';
        }
        return $this->roles->first()->display_name;
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
}
