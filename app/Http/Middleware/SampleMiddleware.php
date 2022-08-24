<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SampleMiddleware
{
    
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-API-KEY');
        if($apiKey == "TRP") {
            return $next($request);
        } else {
            return response('Access Denied', 401);
        }
    }
}
