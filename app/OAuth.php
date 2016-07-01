<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\OAuth
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $user_id
 * @property string $oauth_id
 * @property string $type
 * @property string $payload
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\OAuth whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OAuth whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OAuth whereOauthId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OAuth whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OAuth wherePayload($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OAuth whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OAuth whereUpdatedAt($value)
 */
class OAuth extends Model
{
    protected $fillable = [
        'type', 'oauth_id', 'payload', 'user_id',
    ];
    public $table="oauths";
}
