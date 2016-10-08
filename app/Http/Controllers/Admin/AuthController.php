<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function getLogin(){
        return view('admin.login');
    }
    public function postLogin(){
        
        redirect('/admin');
    }
}
