<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(){
        \View::addNamespace('admin',resource_path('/views/admin/'));
        return view('admin::user/index');
    }
}
