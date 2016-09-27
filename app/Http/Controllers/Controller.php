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

    protected function message($is_success, $message)
    {
        return JsonResponse::create([
            'status' => $is_success?'success': 'fail',
            'message' => $message,
        ],$is_success ? 200 : 500);
    }

    protected function success($m){return $this->message(true, $m);}
}
