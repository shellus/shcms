<?php

namespace App;

use App\Exceptions\UploadedFileException;
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
    private static $disk = 'uploads';

    protected static function boot()
    {
        parent::boot();

        self::deleted(function(self $model){
            $full_path = $model->save_path . '/' . $model->filename;
            $isDeleted = \Storage::disk(self::$disk)->delete($full_path);
            if(!$isDeleted){
                \Log::error("file: $full_path delete fail");
            }else{
                \Log::info("file: $full_path delete success");
            }
        });
    }


    private static function checkExtension($extension){
        if(!in_array($extension, config('app.upload_file_allow_extensions', []))){
            throw new UploadedFileException("extension: $extension is not allow");
        }
    }
    private static function checkFileSize($size){
        if($size > config('app.upload_file_size_limit_byte', 50 * pow(1024, 2))){
            throw new UploadedFileException("File size: $size byte is too big");
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
        self::checkFileSize($file->getSize());

        $random_filename = Str::random() . '.' . $extension;

        $full_path = $file->storeAs($save_path, $random_filename,['disk'=>self::$disk]);

        if($full_path === false){
            throw new UploadedFileSaveFail();
        }

        /** @var self $self */
        $self = self::create([
            'filename' => $random_filename,
            'save_path' => $save_path,
            'display_filename' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
        ]);

        return $self;
    }

    public function getUrlAttribute(){
        return \Storage::disk(self::$disk)->url($this -> save_path .'/'. $this -> filename);
    }
}
