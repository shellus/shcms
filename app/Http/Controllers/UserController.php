<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function updateAvatar(Request $request)
    {
        $user = \Auth::user();
        $file = $request->file('avatar');
        if(!$file->isValid()){
            return $this->fail('上传失败' . $file -> getErrorMessage());
        }
        $save_path = 'avatar/' . \Auth::user() -> id;
        $file_model = File::createFormUploadFile($file, $save_path);
        $user -> avatar() ->associate($file_model);
        $user -> save();
        return $this->success('头像上传成功');
    }
}
