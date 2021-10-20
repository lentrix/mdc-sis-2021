<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        $user = $request->user();

        if(!$user->may($permission)) {
            return back()->with('Error','Sorry, your recent action requires a special permission');
        }

        return $next($request);
    }
}
