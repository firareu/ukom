<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Add logic here to restrict access for regular users
        // For example, allow access only to user's own profile
        // if ($request->route()->getName() === 'profile.edit') {
        //     // Allow access only to user's own profile edit page
        //     if ($request->user()->id != $request->route('profile')) {
        //         return redirect()->route('dashboard')->with('error', 'Unauthorized access');
        //     }
        // }

        // return $next($request);
        if(auth()->user()->role != 'visitor'){
            return redirect()->to('/dashboard');
        }

        return $next($request);

    }
}
