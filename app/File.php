<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
