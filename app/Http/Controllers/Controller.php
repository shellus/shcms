<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Arr;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function message($status, $message, $data = null)
    {
        $statusCodes = [
            'fail' => 500,
            'success' => 200,
            'unauthenticated'=>401,
            'validationException'=>422,

        ];
        if (\Request::expectsJson()){
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data,
            ],$statusCodes[$status]);
        }else{
            return view($status, ['message' => $message, 'return_url'=> \Request::get('_return_url')]);
        }

    }

    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        if ($request->expectsJson()) {
            return $this->validationException($errors);
        }

        return redirect()->to($this->getRedirectUrl())
            ->withInput($request->input())
            ->withErrors($errors, $this->errorBag());
    }
    public function validationException($errors){return $this->message('validationException', Arr::first(Arr::first($errors)), $errors);}
    public function unauthenticated($data = null){return $this->message('unauthenticated', '你需要先登录', $data);}
    protected function fail($m, $data = null){return $this->message('fail', $m, $data);}
    protected function success($m, $data = null){return $this->message('success', $m, $data);}
}
