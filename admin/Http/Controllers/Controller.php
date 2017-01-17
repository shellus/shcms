<?php

namespace Admin\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Symfony\Component\HttpFoundation\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function message($status, $message, $data = null)
    {
        $statusCodes = [
            'fail' => 500,
            'success' => 200,

        ];
        if (\Request::isJson()){
            return JsonResponse::create([
                'status' => $status,
                'message' => $message,
                'data' => $data,
            ],$statusCodes[$status]);
        }else{
            return view($status, ['message' => $message]);
        }

    }
    protected function fail($m, $data = null){return $this->message('fail', $m, $data);}
    protected function success($m, $data = null){return $this->message('success', $m, $data);}
}
