<?php

namespace App\Http\Middleware;

use App\Exceptions\RoleException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role, $guard = null)
    {
        logger($role);
        if (Auth::guard($guard)->guest()) {
            throw RoleException::notLoggedIn();
        }

        $roles = is_array($role)
            ? $role
            : explode('|', $role);

        if (! Auth::guard($guard)->user()->hasAnyRole($roles)) {

            if (!$request->wantsJson()) {
                Auth::logout();
            }

            return abort(403, 'Maaf! Anda tidak mempunyai peranan untuk akses.');
            
        }

        return $next($request);
    }
}
