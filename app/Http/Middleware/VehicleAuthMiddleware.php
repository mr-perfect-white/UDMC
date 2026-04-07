<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VehicleAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('vehicle_user_id')) {
            return redirect('/login');
        }

        return $next($request);
    }
    
    protected function redirectTo($request)
{
    if (!$request->expectsJson()) {
        return route('admin.login');
    }
}



}