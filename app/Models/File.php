<?php namespace App\Models;

use App\Exceptions\UploadedFileException;
use App\Exceptions\UploadedFileSaveFail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

/**
 * App\Models\File
 *
 * @property integer $id
 * @property string $mime_type
 * @property string $size
 * @property string $display_filename
 * @property string $save_path
 * @property string $filename
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read mixed $url
 * @method static \Illuminate\Database\Query\Builder|\App\Models\File whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\File whereMimeType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\File whereSize($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\File whereDisplayFilename($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\File whereSavePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\File whereFilename($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\File whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\File whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class File extends Model
{
    protected $fillable = [
        'filename','save_path','full_path','display_filename','size','mime_type',
    ];

    const disk = 'uploads';


    public function getUrlAttribute(){
        return \Storage::disk(self::disk)->url($this -> save_path .'/'. $this -> filename);
    }
}
