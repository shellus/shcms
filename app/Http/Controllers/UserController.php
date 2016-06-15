<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ControllerTrait\RestControllerTrait;
use App\Http\Requests;

class UserController extends Controller
{
    use RestControllerTrait;

    public function __construct()
    {
        $this -> model = new User();
    }

    public function updateAvatar(Request $request, \Storage $storage)
    {
        $user_id = $request['user_id'];
        $user = User::findOrFail($user_id);

        dump($user);
        dd($request->file('avatar') -> getBasename());
        $storage -> disk('public')->put('',file_get_contents($request->file('avatar')->getRealPath()));
    }
    public function edit($id)
    {
        $data = $this -> model -> findOrFail($id);
        return view('user/edit', ['model' => $data, 'submit_url' => route('avatar.store')]);
    }
}