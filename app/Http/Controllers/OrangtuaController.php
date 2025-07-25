<?php

namespace App\Http\Controllers;

use App\Models\Hafalan;
use App\Models\Raport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrangtuaController extends Controller
{

    //raport index
    public function index()
    {
        $id = Auth::id();

        $id_santri = User::where('id', $id)->value('id_santri_fk');
        $nama = User::where('id', $id)->value('nama');

        $raport = Raport::with('santri', 'santri.programAkademik')
            ->where('id_santri', $id_santri)
            ->orderByRaw('(select pa.nama_program from santri s join program_akademik pa on s.id_program = pa.id where s.id_santri = raports.id_santri) asc')
            ->orderByRaw('(select TA from santri where id_santri = raports.id_santri) asc')
            ->get();

        return view('parents.raport.index', [
            'title' => $nama,
            'active' => 'raport_santri',
            'raport_santri' => $raport
        ]);
    }

    //Hafalan Index
    public function create()
    {
        $id = Auth::id();

        $id_santri = User::where('id', $id)->value('id_santri_fk');
        $nama = User::where('id', $id)->value('nama');

        $Hafalan = Hafalan::with('santri', 'santri.programAkademik')
            ->where('id_santri', $id_santri)
            ->get();

        return view('parents.hafalan.index', [
            'title' => $nama,
            'active' => 'hafalan_santri',
            'hafalan' => $Hafalan
        ]);
    }

    public function dashboardParent()
    {

        return view('parents.index', [
            'title' => 'Dashboard',
            'active' => 'parent',
        ]);
    }

    public function UpdatePassword()
    {
        return view('parents.update_password', [
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

        return redirect()->route('parent.dashboard')->with('success', 'Password berhasil diperbarui');
    }
}
