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
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

         if ($user->isUser()) {
            return $next($request);
        }

        Auth::logout();
        return redirect()->route('login')->withErrors([
            'nim' => 'Role Anda tidak dikenali dalam sistem.',
        ]);
    }
}
