<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function systemInfo(){
        return [
            'site_name' => env('APP_NAME'),
            'site_sub_name' => env('APP_SUB_NAME'),
            'version' => env('APP_VERSION'),
            'env' => env('APP_ENV'),
            'debug' => env('APP_DEBUG'),
            'database' => env('DB_DATABASE'),
        ];
    }
}
