<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\LoginHistory
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $login_ip
 * @property string $user_agent
 * @property string $referer
 * @property string $connection
 * @property boolean $remember
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\LoginHistory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\LoginHistory whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\LoginHistory whereLoginIp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\LoginHistory whereUserAgent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\LoginHistory whereReferer($value)
 * @method static \Illuminate\Database\Query\Builder|\App\LoginHistory whereConnection($value)
 * @method static \Illuminate\Database\Query\Builder|\App\LoginHistory whereRemember($value)
 * @method static \Illuminate\Database\Query\Builder|\App\LoginHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\LoginHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LoginHistory extends Model
{
    protected $fillable = [
        'user_id','login_ip','remember','user_agent','referer','connection',
    ];
}
