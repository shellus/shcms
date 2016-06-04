<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\SiteConfig
 *
 * @property integer $id
 * @property string $type
 * @property string $title
 * @property string $name
 * @property string $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\SiteConfig whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SiteConfig whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SiteConfig whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SiteConfig whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SiteConfig whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SiteConfig whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SiteConfig whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SiteConfig extends Model
{
    //
}
