<?php

namespace App\Http\Middleware;

use App\Enum\Role;
use Closure;
use Illuminate\Http\Request;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        $admin = $request->user();

        if (! in_array($admin->role->value, [Role::ADMIN->value, Role::MANAGER->value])) {
            return redirect()->intended(route('home'));
        }

        return $next($request);
    }
}
