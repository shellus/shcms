<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ControllerTrait\RestControllerTrait;
use App\Http\Requests;

class CategoryController extends Controller
{
    use RestControllerTrait;

    public function __construct()
    {
        $this -> model = new Category();
    }
}
