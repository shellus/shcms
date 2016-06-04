<?php

namespace App;

use App\ModelTrait\ModelHelperTrait;
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Article[] $articles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $display_name
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User autoWithAll()
 * @method static \Illuminate\Database\Query\Builder|\App\User autoTimeScope()
 * @method static \Illuminate\Database\Query\Builder|\App\User autoLimitScope()
 * @method static \Illuminate\Database\Query\Builder|\App\User autoOrderScope()
 * @method static \Illuminate\Database\Query\Builder|\App\User autoEqualFields($fields)
 */
class User extends Authenticatable
{
    use EntrustUserTrait;
    use ModelHelperTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function articles()
    {
        return $this->hasMany('App\Article');
    }
    public function getRoleName(){

    }
    public function displayName(){
        return $this -> display_name;
    }
    public function roleName(){
        try{
            $name = $this -> roles[0] -> display_name;
        }catch (\Exception $err){
            throw new \Exception('the User not role');
        }
        return $name;
    }

}
