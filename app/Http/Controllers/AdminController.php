<?php

namespace App\Http\Controllers;

use App\Models\ProgramAkademik;
use App\Models\Santri;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function dashboard()
    {
        $totalSantri = Santri::count();
        $totalProgram = ProgramAkademik::count();

        return view('admin.index', [
            'title' => 'Dashboard',
            'active' => 'admin',
            'totalSantri' => $totalSantri,
            'totalProgram' => $totalProgram,
        ]);
    }

    public function profile()
    {
        $id = Auth::id();
        $user = User::find($id);
        return view('admin.profile', [
            'title' => 'Profile',
            'active' => 'profile',
            'user' => $user
        ]);
    }
}
