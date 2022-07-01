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
    public function handle(Request $request, Closure $next, $role1, $role2=null)
    {

        $user = $request->user();

        if($user->is('admin')) {
            return $next($request);
        }

        if($user->is($role1)) {
            return $next($request);
        }

        if($role2 && $user->is($role2)) {
            return $next($request);
        }

        return back()->with('Error','Sorry, you are not allowed to perform your recent action.');
    }
}
