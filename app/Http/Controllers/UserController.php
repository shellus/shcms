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
}