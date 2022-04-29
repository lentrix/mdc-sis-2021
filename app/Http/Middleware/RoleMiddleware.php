<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {

        $user = $request->user();

        if(!$user->is($role) && !$user->is('admin')) {
            return back()->with('Error',"Sorry, you are not authorized to perform your recent action.");
        }

        return $next($request);
    }
}
