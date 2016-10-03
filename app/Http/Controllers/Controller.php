<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Symfony\Component\HttpFoundation\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function message($is_success, $message, $data = null)
    {
        if (\Request::isJson()){
            return JsonResponse::create([
                'status' => $is_success?'success': 'fail',
                'message' => $message,
                'data' => $data,
            ],$is_success ? 200 : 500);
        }else{
            return view('success', ['message' => $message]);

        }

    }

    protected function success($m, $data = null){return $this->message(true, $m, $data);}
}
