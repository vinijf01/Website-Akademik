<?php

namespace App\Http\Controllers\Walas;

use App\Http\Controllers\Controller;
use App\Models\ProgramAkademik;
use App\Models\Raport;
use App\Models\Santri;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class RaportController extends Controller
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
            // Jika pengguna adalah walas, ambil data santri berdasarkan id_kelas dari WaliKelas
            $raport = Raport::with('santri', 'santri.programAkademik')
                ->whereHas('santri', function ($query) use ($waliKelas) {
                    $query->where('id_kelas', $waliKelas->id_kelas);
                })
                ->orderByRaw('(select pa.nama_program from santri s join program_akademik pa on s.id_program = pa.id where s.id_santri = raports.id_santri) asc')
                ->orderByRaw('(select TA from santri where id_santri = raports.id_santri) asc')
                ->get();

            return view('walas.raport.index', [
                'title' => 'Raport Santri',
                'active' => 'raport_santri',
                'report_santri' => $raport
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
            return view('walas.raport.create', [
                'title' => 'Raport Santri',
                'active' => 'raport_santri',
                'santri' => $santri,
            ]);
        } else {
            // Jika pengguna bukan walas, berikan tanggapan yang sesuai
            return redirect()->back()->with('error', 'Anda bukan walas.');
        }
    }

    public function store(Request $request)
    {
        // Validasi file
        $this->validate($request, [
            'file_raport' => 'file|mimes:pdf',
            'id_santri' => 'required',
            'semester' => 'required',
        ]);

        // Pemeriksaan apakah data dengan id_santri dan semester yang sama sudah ada
        $existingRaport = Raport::where('id_santri', $request->id_santri)
            ->where('semester', $request->semester)
            ->first();

        if ($existingRaport) {
            return back()->with('error', 'Data ' . $request->semester . ' untuk santri tersebut sudah ada.');
        }

        $fileraport = $this->storeFile($request->file('file_raport'), 'raport_semester');


        Raport::create([
            'id_santri' => $request->id_santri,
            'semester' => $request->semester,
            'file_raport' => $fileraport,
        ]);


        return redirect()->route('walas.raport-santri.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    private function storeFile($file, $folder)
    {
        if ($file) {
            $filename = Str::uuid() . '.' . $file->getClientOriginalName();
            $path = $file->storeAs('public/' . $folder, $filename);

            return $filename;
        }

        return null;
    }


    public function detail($id_santri)
    {
        $data = Raport::with('santri', 'santri.programAkademik')
            ->where('id_santri', $id_santri)
            ->get();
        $program = ProgramAkademik::get();

        return view('walas.raport.detail', [
            'title' => 'Detail Raport Santri',
            'active' => 'raport_santri',
            'raport_santri' => $data,
            'programs' => $program,

        ]);
    }

    public function destroy($id_santri)
    {
        $raports = Raport::where('id_santri', $id_santri)->get();

        foreach ($raports as $raport) {

            $this->deleteFileIfExists($raport->file_raport, 'raport_semester');

            $raport->delete();
        }

        return redirect()->route('walas.raport-santri.index')->with('success', 'Data Berhasil Dihapus');
    }

    private function deleteFileIfExists($filename, $directory)
    {
        $filepath = $directory . '/' . $filename;
        if (Storage::disk('public')->exists($filepath)) {
            Storage::disk('public')->delete($filepath);
        }
    }

    public function edit($id_santri)
    {
        $data = Raport::with('santri', 'santri.programAkademik')
            ->where('id_santri', $id_santri)
            ->get();
        $program = ProgramAkademik::get();
        return view('walas.raport.edit', [
            'title' => 'Raport Santri',
            'active' => 'raport_santri',
            'raport_santri' => $data,
            'programs' => $program,
        ]);
    }

    public function update(Request $request, $id_santri)
    {
        try {
            $raports = Raport::where('id_santri', $id_santri)->get();

            foreach ($raports as $index => $raport) {
                // Gunakan findOrFail untuk mendapatkan data raport
                $raport = Raport::findOrFail($raport->id);

                // Validasi file hanya jika ada file yang diunggah
                if ($request->hasFile('file_raport.' . $index)) {
                    $this->validate($request, [
                        'file_raport.' . $index => 'file|mimes:pdf',
                    ]);

                    // Hapus file lama jika ada
                    $this->deleteFileIfExists($raport->file_raport, 'raport_semester');

                    // Simpan file raport yang baru
                    $fileraport = $this->storeFile($request->file('file_raport.' . $index), 'raport_semester');

                    // Update hanya file_raport
                    $raport->update(['file_raport' => $fileraport]);
                }
            }

            return redirect()->route('walas.raport-santri.index')->with('success', 'Data Berhasil Disimpan');
        } catch (\Exception $e) {
            return redirect()->route('walas.raport-santri.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
