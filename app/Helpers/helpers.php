<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('redirectToDashboard')) {
    function redirectToDashboard()
    {
        return match (Auth::user()->is_permission) {
            1 => redirect()->route('admin.dashboard'),
            2 => redirect()->route('parent.dashboard'),
            3 => redirect()->route('walas.dashboard'),
            default => redirect()->route('login')->withErrors(['akses' => 'Role tidak valid.']),
        };
    }
}
