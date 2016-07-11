<?php

namespace App\Http\Controllers;

use App\Session;
use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    public function getTest(Request $request){
        return 'test route is ok!';
    }
}
