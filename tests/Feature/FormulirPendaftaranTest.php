<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FormulirPendaftaranTest extends TestCase
{
    use DatabaseTransactions;

    public function test_user_can_submit_formulir_pendaftaran()
    {
        // Simulasi penyimpanan file
        Storage::fake('public');

        $response = $this->post('/pendaftaran', [
            'nama_lengkap' => 'Ahmad',
            'jenis_kelamin' => 'Laki-laki',
            'usia' => 12,
            'id_program' => 1,
            'no_wa' => '081234567890',
            'pasphoto' => UploadedFile::fake()->image('pasphoto.jpg'),
            'raport' => UploadedFile::fake()->create('raport.pdf', 100, 'application/pdf'),
            'sk_sekolah' => UploadedFile::fake()->create('sk.pdf', 100, 'application/pdf'),
            'akta' => UploadedFile::fake()->create('akta.pdf', 100, 'application/pdf'),
            'kk' => UploadedFile::fake()->create('kk.pdf', 100, 'application/pdf'),
            'ktp' => UploadedFile::fake()->create('ktp.pdf', 100, 'application/pdf'),
            'bukti_pembayaran' => UploadedFile::fake()->image('bukti.jpg'),
        ]);

        // Cek redirect
        $response->assertRedirect(route('ppdb'));

        // Cek data masuk ke database
        $this->assertDatabaseHas('calon_santri', [
            'nama_lengkap' => 'Ahmad',
            'jenis_kelamin' => 'Laki-laki',
            'usia' => 12,
            'no_wa' => '081234567890',
        ]);
    }
}
