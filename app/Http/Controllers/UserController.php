<?php

namespace App\Http\Controllers;

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
        $this -> model -> setAvatar($file);
        return '头像上传成功';
    }
    public function getAvatar(Request $request, User $user)
    {
        return $user -> getAvatar();
    }
    public function edit()
    {
        return view('user/edit', ['model' => $this -> model, 'submit_url' => route('avatar.store')]);
    }

}