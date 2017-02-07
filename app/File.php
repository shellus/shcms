<?php

namespace App;

use App\Exceptions\UploadedFileExtensionNotAllow;
use App\Exceptions\UploadedFileSaveFail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
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

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::deleting(function(self $model){
            $full_path = $model->save_path . '/' . $model->filename;
            $isDeleted = \Storage::disk('public')->delete($full_path);
            if(!$isDeleted){
                \Log::error("file: $full_path delete fail");
            }else{
                \Log::info("file: $full_path delete success");
            }

        });
    }


    private static function checkExtension($extension){
        if(!in_array($extension, config('app.upload_file_allow_extensions', []))){
            throw new UploadedFileExtensionNotAllow("extension: $extension is not allow");
        }
    }
    /**
     * @param User $user
     * @param UploadedFile $file
     */
    public static function updateUserAvatarByUploadedFile(User $user, UploadedFile $file){
        $save_path = 'avatar/user_' . $user -> getKey();
        $file_model = File::createFormUploadFile($file, $save_path);

        // 如果用户当前已有头像
        if ($user -> avatar()->exists()){
            $user -> avatar -> delete();
        }

        $user -> avatar() ->associate($file_model);
        $user -> save();
    }
    /**
     * @param UploadedFile $file
     * @param string $save_path
     * @return static
     * @throws UploadedFileSaveFail
     */
    public static function createFormUploadFile(UploadedFile $file, $save_path = ''){
        self::checkExtension($extension = $file->getClientOriginalExtension());

        $random_filename = Str::random() . '.' . $extension;

        $full_path = $file->storeAs($save_path, $random_filename);

        if($full_path === false){
            throw new UploadedFileSaveFail();
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
     * @param string $extension
     * @return static
     * @throws UploadedFileSaveFail
     */
    public static function createFormBinary($imageBinary, $path = '', $extension = 'jpg'){
        self::checkExtension($extension);
        $save_path = $path;
        $filename = Str::random() . '.' . $extension;
        $full_path = $save_path . '/' . $filename;
        $result = \Storage::disk('public')->put($full_path, $imageBinary);
        if($result === false){
            throw new UploadedFileSaveFail();
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
