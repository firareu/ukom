<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CekUserLogin
{
    public function handle(Request $request, Closure $next, $role)
    {
        \Log::info('User role: ' . $request->user()->role);
        \Log::info('Required role: ' . $role);

        if (!$request->user() || $request->user()->role !== $role) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Symfony\Component\HttpFoundation\Response;

// class CekUserLogin
// {
//     // public function handle($request, Closure $next)
//     // {
//     //     if (Auth::check() && !Auth::user()->is_admin) {
//     //         return $next($request);
//     //     }
//     //     if (Auth::user()->is_admin) {
//     //         return redirect()->route('admin.dashboard');
//     //     }
//     //     return redirect('/');
//     // }

//     public function handle(Request $request, Closure $next): Response
//     {
//         if(auth()->user()->role != 'visitor'){
//             return redirect()->to('/dashboard');
//         }

//         return $next($request);
//     }
// }
