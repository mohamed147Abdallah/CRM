<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AutoLoginDemo
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
        // For portfolio purposes, automatically authenticate visitors as the admin user.
        if (!Auth::check()) {
            $admin = User::where('email', 'admin@nexus.com')->first();
            if ($admin) {
                Auth::login($admin);
            }
        }

        return $next($request);
    }
}
