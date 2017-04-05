<?php

namespace App\Http\Controllers;

use App\Models\File;
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

        File::updateUserAvatarByUploadedFile($user, $file);

        return $this->success('头像上传成功');
    }
}
