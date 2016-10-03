<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\SearchHistory
 *
 * @property integer $id
 * @property string $word
 * @property integer $page
 * @property integer $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\SearchHistory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SearchHistory whereWord($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SearchHistory wherePage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SearchHistory whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SearchHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SearchHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SearchHistory extends Model
{
    protected $fillable = [
        'word','user_id','page'
    ];

}
