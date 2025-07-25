<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        if ($request->is('admin/*')) {
            return route('admin.login');
        }

        // Tambahkan sesuai kebutuhan lain, contoh:
        if ($request->is('parent/*')) {
            return route('parent.login');
        }

        return route('login'); // default login biasa
    }
}
