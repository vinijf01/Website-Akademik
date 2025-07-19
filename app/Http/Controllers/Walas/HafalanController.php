<?php

namespace App\Http\Controllers\Walas;

use App\Http\Controllers\Controller;
use App\Models\Hafalan;
use App\Models\Santri;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HafalanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'walascheckPermission']);
    }

    public function index()
    {
        // Mendapatkan pengguna yang sedang login
        $user = Auth::user();

        // Memeriksa apakah pengguna adalah walas (dengan id_santri_fk sama dengan id_walas)
        $waliKelas = WaliKelas::where('id_walas', $user->id_santri_fk)->first();

        if ($waliKelas) {
            // Jika pengguna adalah walas, ambil data hafalan santri berdasarkan id_kelas dari WaliKelas
            $hafalan = Hafalan::with('santri')
                ->whereHas('santri', function ($query) use ($waliKelas) {
                    $query->where('id_kelas', $waliKelas->id_kelas);
                })
                ->orderBy('id_santri')
                ->get();

            return view('walas.hafalan.index', [
                'title' => 'Hafalan',
                'active' => 'hafalan',
                'hafalan' => $hafalan,
            ]);
        } else {
            // Jika pengguna bukan walas, berikan tanggapan yang sesuai
            return redirect()->back()->with('error', 'Anda bukan walas.');
        }
    }

    public function create()
    {
        // Mendapatkan pengguna yang sedang login
        $user = Auth::user();

        // Memeriksa apakah pengguna adalah walas (dengan id_santri_fk sama dengan id_walas)
        $waliKelas = WaliKelas::where('id_walas', $user->id_santri_fk)->first();

        if ($waliKelas) {
            // Jika pengguna adalah walas, ambil data santri berdasarkan id_kelas dari WaliKelas
            $santri = Santri::where('id_kelas', $waliKelas->id_kelas)->get();

            return view('walas.hafalan.create', [
                'title' => 'Hafalan',
                'active' => 'hafalan',
                'santri' => $santri,
            ]);
        } else {
            // Jika pengguna bukan walas, berikan tanggapan yang sesuai
            return redirect()->back()->with('error', 'Anda bukan walas.');
        }
    }

    public function store(Request $request)
    {

        Hafalan::create($request->all());

        return redirect()->route('walas-hafalan-santri.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        // Mendapatkan data hafalan berdasarkan ID
        $hafalan = Hafalan::find($id);

        // Memeriksa apakah pengguna adalah walas (dengan id_santri_fk sama dengan id_walas)
        $user = Auth::user();
        $waliKelas = WaliKelas::where('id_walas', $user->id_santri_fk)->first();

        if ($waliKelas) {
            // Jika pengguna adalah walas, ambil data santri berdasarkan id_kelas dari WaliKelas
            $santri = Santri::where('status', 'Lolos')
                ->where('id_kelas', $waliKelas->id_kelas)
                ->get();

            return view('walas.hafalan.edit', [
                'title' => 'Hafalan',
                'active' => 'hafalan',
                'hafalan' => $hafalan,
                'santri' => $santri,
            ]);
        } else {
            // Jika pengguna bukan walas, berikan tanggapan yang sesuai
            return redirect()->back()->with('error', 'Anda bukan walas.');
        }
    }

    public function update(Request $request, $id)
    {
        $data = Hafalan::find($id);
        $data->update($request->all());
        return redirect()->route('walas-hafalan-santri.index')->with('success', 'Data Berhasil Disimpan');
    }

    public function destroy($id)
    {
        $data = Hafalan::find($id);
        $data->delete();
        return redirect()->route('walas-hafalan-santri.index')->with('success', 'Data Berhasil Dihapus');
    }
}
