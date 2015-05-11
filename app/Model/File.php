<?php namespace App\Model;
use Symfony\Component\HttpFoundation\FileBag;

/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2015-04-21
 * Time: 13:02
 */
class File extends Option {
    protected $table="options";

    private static function path(){
        return storage_path().'/app/upload';
    }
    /**
     * 删除文件和记录
     * @param array|int $id
     */
    public function delete(){
        $fileinfo = json_decode($this->value);
        unlink(self::path() . '/' . $fileinfo -> savename);
        Option :: delete();
    }


    /**
     * 储存文件并返回记录
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @return static
     */
    public static function create(array $attributes){
        $file = $attributes['file'];
        $fileinfo = [
            'ext' => $file->getClientOriginalExtension(),
            'name' => $file->getClientOriginalName(),
            'mime' => $file->getMimeType(),
            'size' => $file->getSize(),
            'savename' => $file->getBasename(),
        ];

        $file->move(self::path());

        $attributes['title'] = $fileinfo['name'];
        $attributes['value'] = json_encode($fileinfo);

        return Option::create($attributes);
    }

    public function getFileUrl(){
        return action('FileController@show', $this -> id);
    }
    /**
     * 输出当前文件记录指向的文件
     * @param $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    static public function dumpFile($id){
        $fileinfo = json_decode(self::find($id)->value);

        return \Response::download(
            self::path() . '/' . $fileinfo -> savename,$fileinfo -> name,
            [
                'content-type' => $fileinfo->mime,
            ],
            'inline');
    }
}