<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

class MaintenanceMode
{
    public function handle(Request $request, Closure $next)
    {
        $setting = Setting::first();

        // Check if maintenance mode is ON
        if ($setting && $setting->maintenance_mode) {

            // ✅ Allow all admin routes to work
            if ($request->is('admin/*')) {
                return $next($request);
            }

            // ✅ Allow admin login route (if outside admin/*)
            if ($request->is('login')) {
                return $next($request);
            }

            // ❌ For all other routes, show maintenance page
            return response()->view('maintenance', [
                'text' => $setting->maintenance_mode_text ?? 'The site is currently under maintenance. Please check back later.'
            ]);
        }

        return $next($request);
    }
}
