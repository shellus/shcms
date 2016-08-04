<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
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
 * @property string $full_path
 * @method static \Illuminate\Database\Query\Builder|\App\File whereFullPath($value)
 */
class File extends Model
{
    public function downResponse(){
        $temp_path = tempnam(sys_get_temp_dir(), $this->id);
        file_put_contents($temp_path, \Storage::disk('public')->get($this -> full_path));
        return new BinaryFileResponse($temp_path);
    }
    public function showUrl(){
        return route('file.show',$this -> id);
    }
    /**
     * @param $imageBinary
     * @param string $path
     * @param string $ext
     * @return static
     * @throws \Exception
     */
    public static function createFormBinary($imageBinary, $path = 'uploads', $ext = 'jpg'){
        $save_path = $path;
        $filename = Str::quickRandom() . '.' . $ext;

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
            'description' => '',
            'size' => \Storage::disk('public')->size($full_path),
            'mime_type' => \Storage::disk('public')->mimeType($full_path),
        ]);
    }

}
