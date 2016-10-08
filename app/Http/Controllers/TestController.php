<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    public function index()
    {
        dump(\Request::server());
        dd(\Request::ips());
        return view('test');
    }
}
