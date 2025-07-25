<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CalonSantri;
use App\Models\LaporanTahunanCalonSantri;
use App\Models\ProgramAkademik;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use TCPDF;

/**
 * @OA\Tag(
 *     name="Calon Santri",
 *     description="API untuk mengelola data calon santri"
 * )
 */
class CalonSantriController extends Controller
{
    public function index()
    {
        return view('admin.calon_santri.index', [
            'title' => 'Calon Santri',
            'title2' => 'Laporan Tahunan Calon Santri',
            'active' => 'calon_santri',
            'calon_santri' => CalonSantri::with('program')->get(),
            'laporan_calon_santri' => LaporanTahunanCalonSantri::get()
        ]);
    }

    public function edit($id)
    {
        $program = ProgramAkademik::all();

        $data = CalonSantri::find($id);
        return view('admin.calon_santri.edit', [
            'title' => 'Calon Santri',
            'active' => 'calon_santri',
            'calon_santri' => $data,
            'program' => $program,
        ]);
    }


    /**
     * @OA\Get(
     *     path="/admin/ppdb-calon-santri/detail/{id}",
     *     summary="Detail calon santri",
     *     tags={"Calon Santri"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID Calon Santri",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sukses menampilkan detail calon santri"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Calon santri tidak ditemukan"
     *     )
     * )
     */

    public function detail($id)
    {
        $program_akademik = ProgramAkademik::get();
        $data = CalonSantri::find($id);
        return view('admin.calon_santri.detail', [
            'title' => 'Detail Data Calon Santri',
            'active' => 'calon_santri',
            'calon_santri' => $data,
            'program_akademik' => $program_akademik,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = CalonSantri::find($id);

        // Validasi file
        $this->validate($request, [
            'kk' => 'file|mimes:pdf',
            'sk_sekolah' => 'file|mimes:pdf',
            'akta' => 'file|mimes:pdf',
            'ktp' => 'file|mimes:pdf',
            'raport' => 'file|mimes:pdf',
            'pasphoto' => 'file|mimes:png,jpeg,jpg',
            'bukti_pembayaran' => 'file|mimes:png,jpeg,jpg',
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
            'TA' => $request->TA
        ]);

        $data->save();

        return redirect()->route('admin.ppdb-calon-santri.index')->with('success', 'Data Berhasil Disimpan');
    }

    public function destroy($id)
    {
        $data = CalonSantri::find($id);

        $this->deleteFileIfExists($data->sk_sekolah, 'sk_sekolah');
        $this->deleteFileIfExists($data->akta, 'akta');
        $this->deleteFileIfExists($data->kk, 'KK');
        $this->deleteFileIfExists($data->ktp, 'KTP');
        $this->deleteFileIfExists($data->pasphoto, 'pasphoto');
        $this->deleteFileIfExists($data->raport, 'raport');

        $data->delete();

        return redirect()->route('admin.ppdb-calon-santri.index')->with('success', 'Data Berhasil Dihapus');
    }


    /**
     * @OA\Get(
     *     path="/admin/ppdb-calon-santri/cetak-laporan-tahunan",
     *     summary="Cetak laporan tahunan calon santri",
     *     tags={"Calon Santri"},
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="PDF berhasil dibuat"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Data tahun ajaran belum tersedia"
     *     )
     * )
     */

    public function cetakLaporan()
    {

        $calon_santri = CalonSantri::get();
        // Periksa jika ada Tahun Ajaran
        if ($calon_santri->isEmpty() || $calon_santri->first()->TA === null) {
            return redirect()->back()->with('error', 'Perbarui data Tahun Ajaran terlebih dahulu');
        }
        $pdf = new TCPDF();
        $pdf->setAutoPageBreak(true, 10);
        $pdf->AddPage();

        $HTMLContent = view('admin.calon_santri.raport', ["calon_santri" => $calon_santri])->render();
        $pdf->writeHTML($HTMLContent, true, false, true, false, '');


        $TA = $calon_santri->first()->TA;
        // Memisahkan string berdasarkan karakter '/'
        $parts = explode('/', $TA);
        // Mengambil bagian pertama (tahun awal)
        $tahunAwal = $parts[0];
        $filename = $tahunAwal . '_raport.pdf';
        $pdf->output(public_path('storage/laporan_tahunan_calon_santri/') . $filename, 'F');


        //Create Data Santri
        $calon_santri_diterima = CalonSantri::where('status', 'Diterima')->get();

        // Loop melalui setiap calon santri yang diterima
        foreach ($calon_santri_diterima as $data) {

            $id_santri = $this->generateIdSantri($data->id_program, $data->TA);

            // Memeriksa apakah id_santri sudah ada dalam database
            while (Santri::where('id_santri', $id_santri)->exists()) {
                // Jika sudah ada, generate ulang id_santri
                $id_santri = $this->generateIdSantri($data->id_program, $data->TA);
            }
            // Buat entri baru di tabel User
            Santri::create([
                'nama_lengkap' => $data->nama_lengkap,
                'jenis_kelamin' => $data->jenis_kelamin,
                'usia' => $data->usia,
                'id_program' => $data->id_program,
                'no_wa' => $data->no_wa,
                'pasphoto' => $data->pasphoto,
                'raport' => $data->raport,
                'sk_sekolah' => $data->sk_sekolah,
                'akta' => $data->akta,
                'kk' => $data->kk,
                'ktp' => $data->ktp,
                'status' => $data->status,
                'TA' => $data->TA,
                'id_santri' => $id_santri,
            ]);
        }

        // Create data untuk Tabel Laporan_calon_santri
        LaporanTahunanCalonSantri::create([
            'T_A' => $calon_santri->first()->TA,
            'laporan' => $filename,
        ]);


        // Hapus file data calon yang status nya tidak diterima
        // Ambil semua data CalonSantri
        $calon_santri = CalonSantri::all();

        // Iterasi setiap data
        foreach ($calon_santri as $data) {
            // Jika status bukan 'Diterima'
            if ($data->status !== 'Diterima') {
                // Hapus file-file terkait jika ada
                $this->deleteFileIfExists($data->sk_sekolah, 'sk_sekolah');
                $this->deleteFileIfExists($data->akta, 'akta');
                $this->deleteFileIfExists($data->kk, 'KK');
                $this->deleteFileIfExists($data->ktp, 'KTP');
                $this->deleteFileIfExists($data->pasphoto, 'pasphoto');
                $this->deleteFileIfExists($data->raport, 'raport');
            }
            $this->deleteFileIfExists($data->bukti_pembayaran, 'bukti_pembayaran');
        }

        // Hapus semua data CalonSantri 
        CalonSantri::truncate();

        return redirect()->back();
    }

    public function lihatLaporan($filename)
    {
        $path = storage_path("app/public/laporan_tahunan_calon_santri/{$filename}");

        if (!Storage::exists("public/laporan_tahunan_calon_santri/{$filename}")) {
            abort(404);
        }

        return response()->file($path);
    }


    public function raport()
    {
        $calon_santri = CalonSantri::get();

        return view('admin.calon_santri.raport', [
            'calon_santri' => $calon_santri,
        ]);
    }

    // Fungsi untuk menyimpan file ke direktori storage/public
    private function storeFile($file, $folder)
    {
        if ($file) {
            $filename = Str::uuid() . '.' . $file->getClientOriginalName();
            $path = $file->storeAs('public/' . $folder, $filename);

            return $filename;
        }

        return null;
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

    private function deleteFileIfExists($filename, $directory)
    {
        $filepath = $directory . '/' . $filename;
        if (Storage::disk('public')->exists($filepath)) {
            Storage::disk('public')->delete($filepath);
        }
    }
}
