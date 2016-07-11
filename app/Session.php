<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Session
 *
 * @property string $id
 * @property integer $user_id
 * @property string $ip_address
 * @property string $user_agent
 * @property string $payload
 * @property integer $last_activity
 * @method static \Illuminate\Database\Query\Builder|\App\Session whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Session whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Session whereIpAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Session whereUserAgent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Session wherePayload($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Session whereLastActivity($value)
 * @mixin \Eloquent
 */
class Session extends Model
{
    //
}
