<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\File
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
 * @method static \Illuminate\Database\Query\Builder|\App\File whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereMimeType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereSize($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereDisplayFilename($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereSavePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereFilename($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class File extends Model
{
    protected $fillable = [
        'filename','save_path','full_path','display_filename','size','mime_type',
    ];


    public static function createFormUploadFile(\Illuminate\Http\UploadedFile $file, $save_path = ''){
        $random_filename = Str::random() . '.' . $file->getClientOriginalExtension();
        $full_path = $save_path . '/' . $random_filename;
        $f_context = fopen($file -> getPathname(), 'r');
        $result = \Storage::disk('public')->put($full_path, $f_context);
        fclose($f_context);
        if(!$result){
            throw new \Exception('storage save fail!');
        }
        return self::create([
            'filename' => $random_filename,
            'save_path' => $save_path,
            'display_filename' => $file->getClientOriginalName(),
            'size' => \Storage::disk('public')->size($full_path),
            'mime_type' => \Storage::disk('public')->mimeType($full_path),
        ]);
    }
    /**
     * @param $imageBinary
     * @param string $path
     * @param string $ext
     * @return File
     * @throws \Exception
     */
    public static function createFormBinary($imageBinary, $path = '', $ext = 'jpg'){
        $save_path = $path;
        $filename = Str::random() . '.' . $ext;
        $full_path = $save_path . '/' . $filename;
        $result = \Storage::disk('public')->put($full_path, $imageBinary);
        if(!$result){
            throw new \Exception('storage save fail!');
        }
        return self::create([
            'filename' => $filename,
            'save_path' => $save_path,
            'full_path' => $full_path,
            'title' => $filename,
            'size' => \Storage::disk('public')->size($full_path),
            'mime_type' => \Storage::disk('public')->mimeType($full_path),
        ]);
    }

    public function getUrlAttribute(){
        return '/uploads'.'/'.$this -> save_path .'/'. $this -> filename;
    }
}
