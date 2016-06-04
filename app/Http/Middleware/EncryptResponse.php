<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class EncryptResponse
 * @package App\Http\Middleware
 * 加密返回内容
 */
class EncryptResponse
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /**
         * @var $response \Illuminate\Http\Response
         */
        $response = $next($request);
        if($response ->headers -> get('content-type') == 'application/json'){
            $response->setContent(json_encode(json_decode($response -> getContent()), JSON_UNESCAPED_UNICODE));
        }
        return $response;
    }


}
