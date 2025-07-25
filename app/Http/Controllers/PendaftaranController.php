<?php

namespace App\Http\Controllers;

use App\Models\CalonSantri;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PendaftaranController extends Controller
{
    /**
     * @OA\Post(
     *     path="/pendaftaran",
     *     tags={"Pendaftaran"},
     *     summary="Mendaftar calon santri baru",
     *     operationId="pendaftaranSantri",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"nama_lengkap", "jenis_kelamin", "usia", "id_program", "no_wa", "pasphoto", "raport", "sk_sekolah", "akta", "kk", "ktp", "bukti_pembayaran"},
     *                 @OA\Property(property="nama_lengkap", type="string", example="Ahmad Fauzan"),
     *                 @OA\Property(property="jenis_kelamin", type="string", enum={"Laki-laki", "Perempuan"}),
     *                 @OA\Property(property="usia", type="integer", example=15),
     *                 @OA\Property(property="id_program", type="integer", example=1),
     *                 @OA\Property(property="no_wa", type="string", example="081234567890"),
     *                 
     *                 @OA\Property(property="pasphoto", type="string", format="binary"),
     *                 @OA\Property(property="raport", type="string", format="binary"),
     *                 @OA\Property(property="sk_sekolah", type="string", format="binary"),
     *                 @OA\Property(property="akta", type="string", format="binary"),
     *                 @OA\Property(property="kk", type="string", format="binary"),
     *                 @OA\Property(property="ktp", type="string", format="binary"),
     *                 @OA\Property(property="bukti_pembayaran", type="string", format="binary")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=302,
     *         description="Redirect ke halaman PPDB dengan pesan berhasil"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Gagal menyimpan data"
     *     )
     * )
     */
    public function store(Request $request)
    {
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


        // Simpan file ke direktori storage/private
        $fileraport = $this->storeFile($request->file('raport'), 'raport');
        $filesk_sekolah = $this->storeFile($request->file('sk_sekolah'), 'sk_sekolah');
        $fileAkta = $this->storeFile($request->file('akta'), 'akta');
        $fileKK = $this->storeFile($request->file('kk'), 'KK');
        $fileKTP = $this->storeFile($request->file('ktp'), 'KTP');
        $image = $this->storeFile($request->file('pasphoto'), 'pasphoto');
        $bukti_pembayaran = $this->storeFile($request->file('bukti_pembayaran'), 'bukti_pembayaran');

        $calonSantri = CalonSantri::create([
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'usia' => $request->usia,
            'id_program' => $request->id_program,
            'no_wa' => $request->no_wa,
            'pasphoto' => $image,
            'raport' => $fileraport,
            'sk_sekolah' => $filesk_sekolah,
            'akta' => $fileAkta,
            'kk' => $fileKK,
            'ktp' => $fileKTP,
            'bukti_pembayaran' => $bukti_pembayaran,
        ]);

        if ($calonSantri) {
            // Redirect to PPDB page on success
            return redirect()->route('ppdb')->with('success', 'Data Berhasil Ditambahkan');
        } else {
            // Redirect back to the form with a warning message on failure
            return redirect()->back()->with('warning', 'Gagal menambahkan data. Silakan coba lagi.');
        }
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
}
