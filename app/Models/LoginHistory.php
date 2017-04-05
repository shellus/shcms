<?php namespace App\Models;

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
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LoginHistory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LoginHistory whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LoginHistory whereLoginIp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LoginHistory whereUserAgent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LoginHistory whereReferer($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LoginHistory whereConnection($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LoginHistory whereRemember($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LoginHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LoginHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LoginHistory extends Model
{
    protected $fillable = [
        'user_id','login_ip','remember','user_agent','referer','connection',
    ];
}
