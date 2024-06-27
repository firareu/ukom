<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {

        if(auth()->user()->role == 'visitor'){
            return redirect()->to('/dashboard');
        }

        return $next($request);

    }
}
