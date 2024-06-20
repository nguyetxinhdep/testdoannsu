<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RuleUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd('Middleware RuleUser');
        if(Auth::user()->rule == 1){
            return $next($request);
        }
        return abort(404);
    }
}
