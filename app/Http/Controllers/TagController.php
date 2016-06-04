<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\ControllerTrait\RestControllerTrait;
use App\Http\Requests;

class TagController extends Controller
{
    use RestControllerTrait;

    public function __construct()
    {
        $this -> model = new Tag();
    }
}
