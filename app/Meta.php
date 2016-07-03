<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Meta
 *
 * @property integer $id
 * @property string $type
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property integer $parent_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Meta whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Meta whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Meta whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Meta whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Meta whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Meta whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Meta whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Meta whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Meta extends Model
{
    protected $table = 'metas';
    protected $fillable = [
        'title','user_id','description','parent_id'
    ];
}
 