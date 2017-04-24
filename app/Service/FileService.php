<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2017/4/14
 * Time: 9:54
 */

namespace App\Service;


use App\Exceptions\UploadedFileException;
use App\Exceptions\UploadedFileSaveFail;
use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class FileService
{
    /**
     * 检查上传文件扩展名是否允许
     * @param $extension
     * @throws UploadedFileException
     */
    private static function checkExtension($extension)
    {
        if (!in_array($extension, config('app.upload_file_allow_extensions', ['jpg', 'jpeg']))) {
            throw new UploadedFileException("extension: $extension is not allow");
        }
    }

    /**
     * 检查上传文件尺寸，不得超过50K
     * @param $size
     * @throws UploadedFileException
     */
    private static function checkFileSize($size)
    {
        if ($size > config('app.upload_file_size_limit_byte', 50 * pow(1024, 2))) {
            throw new UploadedFileException("File size: $size byte is too big");
        }
    }

    /**
     * 从上传文件创建文件模型
     * @param UploadedFile $file
     * @param string $save_path
     * @return static
     * @throws UploadedFileSaveFail
     */
    public static function createFormUploadFile(UploadedFile $file, $save_path = '')
    {

        self::checkExtension($extension = $file->getClientOriginalExtension());
        self::checkFileSize($file->getSize());

        $random_filename = Str::random() . '.' . $extension;

        $full_path = $file->storeAs($save_path, $random_filename, ['disk' => File::disk]);

        if ($full_path === false) {
            throw new UploadedFileSaveFail();
        }

        /** @var self $self */
        $self = File::create([
            'filename' => $random_filename,
            'save_path' => $save_path,
            'display_filename' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
        ]);

        return $self;
    }

    public function delete(File $model){
        $originModel = clone $model;
        $model->delete();
        $this->deleted($originModel);
    }

    /**
     * 删除了FileModel必须调用一下这个方法来清理文件
     * @param File $model
     */
    public function deleted(File $model)
    {
        $full_path = $model->save_path . '/' . $model->filename;
        $isDeleted = \Storage::disk(File::disk)->delete($full_path);
        if (!$isDeleted) {
            \Log::error("file: $full_path delete fail");
        } else {
            \Log::info("file: $full_path delete success");
        }
    }
}