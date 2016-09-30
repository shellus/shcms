<?php

namespace App\Http\Controllers;

use App\FavoriteDirectory;
use Illuminate\Http\Request;

use App\Http\Requests;

class FavoriteController extends Controller
{


    public function add(){
        $favorite_directories = FavoriteDirectory::whereUserId(\Auth::user() -> id) -> get();
        return view('favorite.add', compact(['favorite_directories']));
    }
}
