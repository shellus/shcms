<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class AdminAccessMiddleware
{
    protected $auth;
    protected $except = [
        'admin/login',
    ];
    /**
     * Creates a new instance of the middleware.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        if(!$request -> is('admin/login')){
            if ($this->auth->guest()) {
                return redirect('/admin/login');
            }
            if (!$request->user()->hasRole(explode('|', $roles))){
                return abort(403);
            }
        }


        return $next($request);
    }
}
