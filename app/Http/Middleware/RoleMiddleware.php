<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $roleIds = ['admin' => 1, 'user' => 2];
        $allowedRoleIds = [];
        foreach ($roles as $role) {
            if(isset($roleIds[$role])) {
                $allowedRoleIds[] = $roleIds[$role];
            }
        }
        
        $allowedRoleIds = array_unique($allowedRoleIds); 

        if(Auth::check()) {
            if(!in_array(Auth::user()->roles, $allowedRoleIds)) {
                Session::flash('alert-danger', "Access denied.");
                return redirect()->back();
            }
        }

        return $next($request);
    }
}
