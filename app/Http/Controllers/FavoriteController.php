<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\FavoriteDirectory;
use App\FavoriteDirectoryStar;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;

class FavoriteController extends Controller
{

    public function showAddArticleToFavorite(){
        $favorite_directories = FavoriteDirectory::whereUserId(\Auth::user() -> id) -> get();
        return view('favorite.add', compact(['favorite_directories']));
    }
    public function addArticleToFavorite(Request $request){
        $data = $request -> only(['article_id', 'favorite_directory_id']);
        $data['user_id'] = \Auth::user() -> id;
        try{
            $model = Favorite::create($data);
        }catch (QueryException $e){
            return $this -> fail('操作失败，可能已经有人收藏了哦');
        }

        return $this -> success('收藏成功', $model);
    }
}
