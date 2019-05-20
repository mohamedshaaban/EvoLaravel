<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use App\User;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $role_id = $user->role_id;
            // check role id for buyer Account 
            if ($role_id == User::HOST_USER_ROLE_ID && $request->is('customer/*')) {
                return redirect()->back();
            } elseif (($role_id == User::NORMAL_USER_ROLE_ID && $request->is('host/*'))) {
                return redirect()->back();
            }

        }
        return $next($request);

    }
}
