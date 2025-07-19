<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\ProgramAkademik;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'checkPermission']);
    }

    public function index()
    {
        return view('admin.kelas.index', [
            'title' => 'Kelas',
            'active' => 'kelas',
            'kelas' => Kelas::with('programAkademik')->get()
        ]);
    }

    public function create()
    {
        $program = ProgramAkademik::get();
        return view('admin.kelas.create', [
            'title' => 'Kelas',
            'active' => 'kelas',
            'program' => $program

        ]);
    }

    public function store(Request $request)
    {
        Kelas::create($request->all());

        return redirect()->route('admin-kelas.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $data = Kelas::find($id);
        $program = ProgramAkademik::get();
        return view('admin.kelas.edit', [
            'title' => 'Kelas',
            'active' => 'kelas',
            'kelas' => $data,
            'program' => $program
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = Kelas::find($id);
        $data->update($request->all());
        return redirect()->route('admin-kelas.index')->with('success', 'Data Berhasil Disimpan');
    }

    public function destroy($id)
    {
        $data = Kelas::find($id);
        $data->delete();
        return redirect()->route('admin-kelas.index')->with('success', 'Data Berhasil Dihapus');
    }
}
