<?php

namespace Tests\Feature;

use App\Models\Berita;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BeritaCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_berita_with_image()
    {
        Storage::fake('public');

        $admin = User::factory()->create(['is_permission' => 1]);

        $this->actingAs($admin);

        $image = UploadedFile::fake()->image('foto.jpg');

        $response = $this->post('/admin/berita', [
            'judul' => 'Judul Test',
            'isi' => 'Ini adalah isi test berita',
            'penulis' => 'Ustadz Vini',
            'foto' => $image,
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('berita', [
            'judul' => 'Judul Test',
            'isi' => 'Ini adalah isi test berita',
            'penulis' => 'Ustadz Vini',
        ]);

        $files = scandir(public_path('assets/img/blog'));
        $fileFound = collect($files)->contains(fn($file) => str_contains($file, 'foto.jpg'));

        $this->assertTrue($fileFound, 'File foto.jpg tidak ditemukan di assets/img/blog');
    }

    public function test_admin_can_view_daftar_berita()
    {
        $admin = User::factory()->create(['is_permission' => 1]);
        $this->actingAs($admin);

        // Tambahkan berita secara manual (tanpa factory)
        Berita::create([
            'judul' => 'Berita 1',
            'isi' => 'Isi Berita 1',
            'penulis' => 'Admin',
            'foto' => 'foto1.jpg',
        ]);

        $response = $this->get('/admin/berita');

        $response->assertStatus(200);
        $response->assertSeeText('Berita'); // Ubah jika tampilanmu berbeda
    }

    public function test_admin_can_update_berita()
    {
        $admin = User::factory()->create(['is_permission' => 1]);
        $this->actingAs($admin);

        $berita = Berita::create([
            'judul' => 'Judul Lama',
            'isi' => 'Isi Lama',
            'penulis' => 'Admin Lama',
            'foto' => 'lama.jpg',
        ]);

        $response = $this->put("/admin/berita/{$berita->id}", [
            'judul' => 'Judul Baru',
            'isi' => 'Isi Baru',
            'penulis' => 'Admin Baru',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('berita', [
            'id' => $berita->id,
            'judul' => 'Judul Baru',
            'isi' => 'Isi Baru',
            'penulis' => 'Admin Baru',
        ]);
    }

    public function test_admin_can_delete_berita()
    {
        $admin = User::factory()->create(['is_permission' => 1]);
        $this->actingAs($admin);

        $berita = Berita::create([
            'judul' => 'Berita yang Akan Dihapus',
            'isi' => 'Isi Berita',
            'penulis' => 'Admin',
            'foto' => 'hapus.jpg',
        ]);

        $response = $this->delete("/admin/berita/{$berita->id}");

        $response->assertRedirect();

        $this->assertDatabaseMissing('berita', [
            'id' => $berita->id,
        ]);
    }
}
