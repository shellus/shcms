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
        $save_path = 'avatar/' . \Auth::user() -> id;
        $file_model = File::createFormUploadFile($file, $save_path);
        $user -> avatar() ->associate($file_model);
        $user -> save();
        return '头像上传成功';
    }
}
