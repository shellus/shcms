<?php

namespace App\Http\Controllers;

use App\File;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ControllerTrait\RestControllerTrait;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class UserController extends Controller
{
    use RestControllerTrait;

    public function __construct()
    {
        $this -> model = \Auth::user();
    }
    public function updateAvatar(Request $request)
    {
        $file = $request->file('avatar');


        $file_model = File::createFormFilePath($file -> getPathname(), 'avatar/' . \Auth::user() -> id);

        $this -> model -> avatar() ->associate($file_model);
        $this -> model -> save();
        return '头像上传成功';
    }
    public function getAvatar(Request $request, User $user)
    {
        return $user -> getAvatar();
    }
    public function edit()
    {
        return view('user/edit', ['title' => '修改用户资料', 'model' => $this -> model, 'submit_url' => route('avatar.store')]);
    }

}