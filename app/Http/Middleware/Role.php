<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ... $role)
    {
        $user = Auth::user();
        $roles = [
            'manager' => 1,
            'cashier' => 2,
        ];

        if ($user->type_id == $roles[$role[0]]) {
            return $next($request);
        }

        return redirect('login');
    }
}
