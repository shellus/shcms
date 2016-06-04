<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * App\File
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\File whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property integer $article_id
 * @property string $title
 * @property string $filename
 * @property string $mime_type
 * @property string $size
 * @property string $value
 * @property string $save_path
 * @property string $description
 * @method static \Illuminate\Database\Query\Builder|\App\File whereArticleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereFilename($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereMimeType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereSize($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereSavePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereDescription($value)
 */
class File extends Model
{
    private $path = '/home/shellus/ftp/sex/app/upload/';
    
    public function downResponse(){
        return new BinaryFileResponse($this -> path . $this -> save_path);
    }
}
