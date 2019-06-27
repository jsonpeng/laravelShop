<?php

namespace App\Http\Middleware;

use Closure;
use Overtrue\Socialite\User as SocialiteUser;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class ZCJYWebCertMiddleware
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
        $cert_varify = app('commonRepo')->varifyCert(auth('web')->user());
        if($cert_varify){
            return $cert_varify;
        }
        return $next($request);
    }
}
