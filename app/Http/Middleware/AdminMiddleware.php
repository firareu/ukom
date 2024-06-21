<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->role != 'admin'){
            return redirect()->to('/dashboard');
        }else{
            // return redirect()->to('/dashboardadmin');
        }

        return $next($request);
    }

    // public function handle(Request $request, Closure $next)
    // {
    //     if (!auth()->user() || auth()->user()->role !== 'admin') {
    //         return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
    //     }

    //     return $next($request);
    // }
}
