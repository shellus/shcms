<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;

use App\Http\Requests;

class FileController extends Controller
{
    public function __construct()
    {
        $this -> model = new File();
    }
    public function show($id){
        return $this -> model -> findOrFail($id) -> downResponse();
    }
}
