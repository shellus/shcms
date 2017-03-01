<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Region
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string $alias
 * @property string $pinyin
 * @property string $abbr
 * @property string $zip
 * @property bool $level
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Region whereAbbr($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Region whereAlias($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Region whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Region whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Region whereLevel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Region whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Region whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Region wherePinyin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Region whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Region whereZip($value)
 * @mixin \Eloquent
 */
class Region extends Model
{
    const LEVELS = [
        'province' => 1,
        'city' => 2,
        'county' => 3,
    ];
}
