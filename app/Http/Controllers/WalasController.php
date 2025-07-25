<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class WalasController extends Controller
{

    public function dashboardWalas()
    {

        return view('walas.index', [
            'title' => 'Dashboard',
            'active' => 'walas',
        ]);
    }

    public function UpdatePassword()
    {
        return view('walas.update_password', [
            'title' => 'Password',
            'active' => 'password',
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('walas.dashboard')->with('success', 'Password berhasil diperbarui');
    }
}
