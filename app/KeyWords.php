<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\KeyWords
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $word
 * @property integer $weights
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\KeyWords whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\KeyWords whereWord($value)
 * @method static \Illuminate\Database\Query\Builder|\App\KeyWords whereWeights($value)
 * @method static \Illuminate\Database\Query\Builder|\App\KeyWords whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\KeyWords whereUpdatedAt($value)
 */
class KeyWords extends Model
{
    protected $fillable = [
        'word','weight',
    ];
}
