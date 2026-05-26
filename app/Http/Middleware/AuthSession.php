<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthSession
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->has('user_account_id')) {
            return redirect('/')->with('msg', 'Please login first.');
        }

        return $next($request);
    }
}
