<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\User;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WalasController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'checkPermission']);
    }

    public function index()
    {
        return view('admin.walas.index', [
            'title' => 'Wali Kelas',
            'active' => 'wali-kelas',
            'walas' => WaliKelas::with('kelas')->get()
        ]);
    }

    public function create()
    {
        $kelas = Kelas::get();
        return view('admin.walas.create', [
            'title' => 'Wali Kelas',
            'active' => 'wali-kelas',
            'kelas' => $kelas

        ]);
    }

    public function store(Request $request)
    {
        // Membuat id_walas secara acak menggunakan fungsi Str::random()
        $id_walas = Str::random(8);

        // Menambahkan id_walas yang dihasilkan ke dalam data request
        $requestData = $request->all();
        $requestData['id_walas'] = $id_walas;

        // Menyimpan data ke dalam database
        $walas =  WaliKelas::create($requestData);

        //membuat data di tabel user
        if ($walas) {
            User::create([
                'password' => bcrypt('Walas123'),
                'nama' => $walas->nama,
                'id_santri_fk' => $walas->id_walas,
                'is_permission' => 3
            ]);
        }

        return redirect()->route('admin-wali-kelas.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $kelas = Kelas::get();
        $data = WaliKelas::find($id);
        return view('admin.walas.edit', [
            'title' => 'Wali Kelas',
            'active' => 'wali-kelas',
            'walas' => $data,
            'kelas' => $kelas

        ]);
    }

    public function update(Request $request, $id)
    {
        // Temukan data wali kelas berdasarkan ID
        $waliKelas = WaliKelas::find($id);

        // Pastikan data ditemukan
        if (!$waliKelas) {
            return redirect()->route('admin-wali-kelas.index')->with('error', 'Data tidak ditemukan');
        }

        // Generate id_walas baru
        $id_walas = Str::random(8); // Menghasilkan string acak dengan panjang 8 karakter

        // Temukan data user berdasarkan id_santri_fk
        $user = User::where('id_santri_fk', $waliKelas->id_walas)->first();

        // Update data wali kelas dengan data baru
        $waliKelas->update(array_merge($request->all(), ['id_walas' => $id_walas]));




        // Pastikan data user ditemukan
        if ($user) {
            // Update nama user dengan nama wali kelas yang baru
            $user->update([
                'password' => bcrypt('Walas123'),
                'nama' => $waliKelas->nama,
                'id_santri_fk' => $waliKelas->id_walas,
            ]);
        }

        return redirect()->route('admin-wali-kelas.index')->with('success', 'Data Berhasil Disimpan');
    }

    public function destroy($id)
    {
        // Temukan data wali kelas berdasarkan ID
        $waliKelas = WaliKelas::find($id);

        // Pastikan data ditemukan
        if (!$waliKelas) {
            return redirect()->route('admin-wali-kelas.index')->with('error', 'Data tidak ditemukan');
        }

        // Hapus data wali kelas
        $waliKelas->delete();

        // Temukan dan hapus data user yang terkait
        $user = User::where('id_santri_fk', $waliKelas->id_walas)->first();
        if ($user) {
            $user->delete();
        }

        return redirect()->route('admin-wali-kelas.index')->with('success', 'Data Berhasil Dihapus');
    }
}
