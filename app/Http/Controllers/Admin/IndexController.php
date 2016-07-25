<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.layout',['content'=>'ok']);
    }
    public function test(){
        User::latest()
    }
}
