<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function systemInfo(){
        return [
            'site_name' => config('app.name'),
            'site_sub_name' => config('app.sub_name'),
            'version' => config('app.version'),
            'env' => config('app.env'),
            'debug' => config('app.debug'),
            'database' => config('database.connections.mysql.database'),
        ];
    }
}
