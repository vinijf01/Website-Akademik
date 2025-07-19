<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\LaporanTahunanAlumni;
use App\Models\ProgramAkademik;
use App\Models\Raport;
use App\Models\Santri;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use TCPDF;


class SantriController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'checkPermission']);
    }


    public function index()
    {
        $santri = Santri::with('programAkademik', 'kelas')
            ->orderBy('id_program', 'asc')
            ->orderBy('jenis_kelamin')
            ->orderBy('id_kelas', 'asc')
            ->get();

        return view('admin.santri.index', [
            'title' => 'Data Santri',
            'title2' => 'Laporan Tahunan Alumni',
            'active' => 'data_santri',
            'santri' => $santri,
            'laporan_alumni' => LaporanTahunanAlumni::get()
        ]);
    }


    public function create()
    {
        $program_akademik = ProgramAkademik::get();
        return view('admin.santri.create', [
            'title' => 'Data Santri',
            'active' => 'data',
            'program_akademik' => $program_akademik
        ]);
    }

    public function store(Request $request)
    {

        $id_santri = $this->generateIdSantri($request->id_program, $request->TA);

        // Memeriksa apakah id_santri sudah ada dalam database
        while (Santri::where('id_santri', $id_santri)->exists()) {
            // Jika sudah ada, generate ulang id_santri
            $id_santri = $this->generateIdSantri($request->id_program, $request->TA);
        }

        Santri::create([
            'id_program' => $request->id_program,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'usia' => $request->usia,
            'no_wa' => $request->no_wa,
            'TA' => $request->TA,
            'id_santri' => $id_santri,

        ]);

        return redirect()->route('admin-data-santri.index')->with('success', 'Data Berhasil Disimpan');
    }


    public function edit($id)
    {
        $kelas = Kelas::get();
        $data = Santri::find($id);
        $program = ProgramAkademik::get();
        return view('admin.santri.edit', [
            'title' => 'Data Santri',
            'active' => 'data_santri',
            'data_santri' => $data,
            'kelas' => $kelas,
            'programs' => $program
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = Santri::find($id);

        // Validasi file
        $this->validate($request, [
            'kk' => 'file|mimes:pdf',
            'sk_sekolah' => 'file|mimes:pdf',
            'akta' => 'file|mimes:pdf',
            'ktp' => 'file|mimes:pdf',
            'raport' => 'file|mimes:pdf',
            'pasphoto' => 'file|mimes:png,jpeg,jpg'
        ]);

        $fileraport = $data->raport;
        $filesk_sekolah = $data->sk_sekolah;
        $fileAkta = $data->akta;
        $fileKK = $data->kk;
        $fileKTP = $data->ktp;
        $Filepasphoto = $data->pasphoto;

        if ($request->hasFile('raport')) {
            $this->deleteFileIfExists($data->raport, 'raport');
            $fileraport = $this->storeFile($request->file('raport'), 'raport');
        }

        if ($request->hasFile('sk_sekolah')) {
            $this->deleteFileIfExists($data->sk_sekolah, 'sk_sekolah');
            $filesk_sekolah = $this->storeFile($request->file('sk_sekolah'), 'sk_sekolah');
        }

        if ($request->hasFile('akta')) {
            $this->deleteFileIfExists($data->akta, 'akta');
            $fileAkta = $this->storeFile($request->file('akta'), 'akta');
        }

        if ($request->hasFile('kk')) {
            $this->deleteFileIfExists($data->kk, 'KK');
            $fileKK = $this->storeFile($request->file('kk'), 'KK');
        }

        if ($request->hasFile('ktp')) {
            $this->deleteFileIfExists($data->ktp, 'KTP');
            $fileKTP = $this->storeFile($request->file('ktp'), 'KTP');
        }

        if ($request->hasFile('pasphoto')) {
            $this->deleteFileIfExists($data->pasphoto, 'pasphoto');
            $Filepasphoto = $this->storeFile($request->file('pasphoto'), 'pasphoto');
        }
        // Simpan data lainnya
        $data->update([
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'usia' => $request->usia,
            'id_program' => $request->id_program,
            'no_wa' => $request->no_wa,
            'pasphoto' => $Filepasphoto,
            'raport' => $fileraport,
            'sk_sekolah' => $filesk_sekolah,
            'akta' => $fileAkta,
            'kk' => $fileKK,
            'ktp' => $fileKTP,
            'status' => $request->status,
            'TA' => $request->TA,
            'id_kelas' => $request->id_kelas
        ]);

        // Jika status menjadi 'Aktiv', pindahkan data ke tabel Users
        if ($request->status == 'Aktiv') {
            // Mengecek apakah data dengan id_santri_fk yang sama sudah ada di tabel user
            $existingUser = User::where('id_santri_fk', $data->id_santri)->first();

            // Jika data belum ada, maka buat entri baru di tabel user
            if (!$existingUser) {
                User::create([
                    'password' => bcrypt('Santri123'),
                    'nama' => $data->nama_lengkap,
                    'id_santri_fk' => $data->id_santri,
                ]);
            }
        }
        return redirect()->route('admin-data-santri.index')->with('success', 'Data Berhasil Disimpan');
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


    private function deleteFileIfExists($filename, $directory)
    {
        $filepath = $directory . '/' . $filename;
        if (Storage::disk('public')->exists($filepath)) {
            Storage::disk('public')->delete($filepath);
        }
    }

    public function detail($id)
    {
        $data = Santri::find($id);
        $kelas = Kelas::get();
        $program = ProgramAkademik::get();
        return view('admin.santri.detail', [
            'title' => 'Detail Data Santri',
            'active' => 'data_santri',
            'data_santri' => $data,
            'programs' => $program,
            'kelas' =>  $kelas,
        ]);
    }

    public function destroy($id)
    {
        // Temukan data santri berdasarkan ID
        $santri = Santri::find($id);

        // Pastikan data ditemukan
        if (!$santri) {
            return redirect()->route('admin-data-santri.index')->with('error', 'Data tidak ditemukan');
        }

        // Temukan dan hapus data user yang memiliki id_santri_fk yang sama dengan id_santri
        $users = User::where('id_santri_fk', $santri->id_santri)->get();
        foreach ($users as $user) {
            $user->delete();
        }

        // Hapus file-file terkait jika ada
        $this->deleteFileIfExists($santri->sk_sekolah, 'sk_sekolah');
        $this->deleteFileIfExists($santri->akta, 'akta');
        $this->deleteFileIfExists($santri->kk, 'KK');
        $this->deleteFileIfExists($santri->ktp, 'KTP');
        $this->deleteFileIfExists($santri->pasphoto, 'pasphoto');
        $this->deleteFileIfExists($santri->raport, 'raport');

        // Hapus data santri
        $santri->delete();

        return redirect()->route('admin-data-santri.index')->with('success', 'Data Berhasil Dihapus');
    }

    public function raport_wustho()
    {
        $santri = Santri::with('kelas')->where('id_program', 1)->get();

        return view('admin.santri.raport_wustho', [
            'santri' => $santri,
        ]);
    }

    public function raport_ulya()
    {
        $santri = Santri::with('kelas')->where('id_program', 2)->get();

        return view('admin.santri.raport_ulya', [
            'santri' => $santri,
        ]);
    }

    public function raport_takhosus()
    {
        $santri = Santri::with('kelas')->where('id_program', 3)->get();

        return view('admin.santri.raport_takhosus', [
            'santri' => $santri,
        ]);
    }

    public function raport_idad()
    {
        $santri = Santri::with('kelas')->where('id_program', 4)->get();

        return view('admin.santri.raport_idad', [
            'santri' => $santri,
        ]);
    }

    private function generateIdSantri($idProgram, $tahunAjaran)
    {
        $tahunAjaranParts = explode('/', $tahunAjaran);

        // Mengambil elemen pertama dari array (bagian pertama tahun ajaran)
        $tahunAjaran = $tahunAjaranParts[0];

        // Memastikan tahun ajaran tidak kosong dan sesuai dengan format yang diinginkan
        if (empty($tahunAjaran)) {
            $tahunAjaran = date('Y');
        }

        $idProgramFormatted = str_pad($idProgram, 2, '00', STR_PAD_LEFT); // Menambahkan '0' di depan jika hanya satu digit
        return $tahunAjaran . $idProgramFormatted . rand(10, 99); // Contoh penggabungan tahun ajaran, id_program, dan angka random
    }


    public function cetakLaporan()
    {

        $alumni = Santri::where('status', 'Alumni')->get();

        // Periksa jika ada Tahun Ajaran
        if ($alumni->isEmpty() || $alumni->first()->TA === null) {
            return redirect()->back()->with('error', 'Perbarui data Tahun Ajaran terlebih dahulu');
        }
        $pdf = new TCPDF();
        $pdf->setAutoPageBreak(true, 10);
        $pdf->AddPage();

        $HTMLContent = view('admin.santri.raport_alumni', ["alumni" => $alumni])->render();
        $pdf->writeHTML($HTMLContent, true, false, true, false, '');


        $TA = $alumni->first()->TA;
        // Memisahkan string berdasarkan karakter '/'
        $parts = explode('/', $TA);
        // Mengambil bagian pertama (tahun awal)
        $tahunAwal = $parts[0];
        $filename = $tahunAwal . '_raport.pdf';
        $pdf->output(public_path('storage/laporan_tahunan_alumni/') . $filename, 'F');

        // Create data untuk Tabel Laporan_alumni
        LaporanTahunanAlumni::create([
            'T_A' => $alumni->first()->TA,
            'laporan' => $filename,
        ]);

        // Iterasi setiap data
        foreach ($alumni as $data) {
            // Hapus file-file terkait jika ada
            $this->deleteFileIfExists($data->sk_sekolah, 'sk_sekolah');
            $this->deleteFileIfExists($data->akta, 'akta');
            $this->deleteFileIfExists($data->kk, 'KK');
            $this->deleteFileIfExists($data->ktp, 'KTP');
            $this->deleteFileIfExists($data->pasphoto, 'pasphoto');
            $this->deleteFileIfExists($data->raport, 'raport');
            $this->deleteFileIfExists($data->bukti_pembayaran, 'bukti_pembayaran');

            $raport = Raport::where('id_santri', $data->id_santri)->get();
            foreach ($raport as $fileraport) {
                $this->deleteFileIfExists($fileraport->file_raport, 'raport_semester');
            }
        }

        // Hapus semua data CalonSantri 
        Santri::where('status', 'Alumni')->delete();

        return redirect()->back();
    }

    public function lihatLaporan($filename)
    {
        $path = storage_path("app/public/laporan_tahunan_alumni/{$filename}");

        if (!Storage::exists("public/laporan_tahunan_alumni/{$filename}")) {
            abort(404);
        }

        return response()->file($path);
    }


    public function raport()
    {
        $calon_santri = Santri::where('status', 'Alumni')->get();

        return view('admin.santri.raport_alumni', [
            'calon_santri' => $calon_santri,
        ]);
    }
}
