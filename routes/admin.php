<?php

use App\Http\Controllers\Admin\{
    HeroController,
    ProgramAkademikController,
    KetuaProgramController,
    TentangPesantrenController,
    EkstrakulikulerController,
    FaqController,
    TestimoniController,
    BeritaController,
    GaleriController,
    VisiMisiController,
    KataPengantarController,
    FotoProgramAkademikController,
    KeteranganClassController,
    JadwalHarianController,
    HeroPPDBController,
    SyaratController,
    BankController,
    CaraPendaftaranController,
    BiayaPendidikanController,
    PeminatController,
    CalonSantriController,
    SantriController,
    FasilitasController,
    ImageFasilitasController,
    KelasController,
    WalasController
};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLogoutController;

Route::post('/logout', [AdminLogoutController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'checkRole:1'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});


// Resource Routes
Route::resources([
    'hero' => HeroController::class,
    'program-akademik' => ProgramAkademikController::class,
    'ketua-program' => KetuaProgramController::class,
    'tentang-pesantren' => TentangPesantrenController::class,
    'ekstrakulikuler' => EkstrakulikulerController::class,
    'faq' => FaqController::class,
    'testimoni' => TestimoniController::class,
    'berita' => BeritaController::class,
    'galeri' => GaleriController::class,
    'visi-misi' => VisiMisiController::class,
    'kata-pengantar' => KataPengantarController::class,
    'foto-kegiatan-program' => FotoProgramAkademikController::class,
    'keterangan-kelas' => KeteranganClassController::class,
    'jadwal-harian' => JadwalHarianController::class,
    'hero-ppdb' => HeroPPDBController::class,
    'ppdb-syarat' => SyaratController::class,
    'ppdb-bank' => BankController::class,
    'ppdb-cara-pendaftaran' => CaraPendaftaranController::class,
    'ppdb-biaya-pendidikan' => BiayaPendidikanController::class,
    'ppdb-peminat' => PeminatController::class,
    'ppdb-calon-santri' => CalonSantriController::class,
    'data-santri' => SantriController::class,
    'fasilitas' => FasilitasController::class,
    'image-fasilitas' => ImageFasilitasController::class,
    'kelas' => KelasController::class,
    'wali-kelas' => WalasController::class,
]);


// Custom routes
Route::get('tentang-pesantren/edit_dk/{id}', [TentangPesantrenController::class, 'edit_dk'])->name('tentang-pesantren.edit_dk');
Route::put('tentang-pesantren/update_dk/{id}', [TentangPesantrenController::class, 'update_dk'])->name('tentang-pesantren.update_dk');

Route::get('ppdb-calon-santri/detail/{id}', [CalonSantriController::class, 'detail'])->name('ppdb-calon-santri.detail');
Route::get('ppdb-calon-santri/cetak-laporan-tahunan', [CalonSantriController::class, 'cetakLaporan'])->name('ppdb-calon-santri.cetakLaporan');
Route::get('laporan-tahunan-calon-santri', [CalonSantriController::class, 'raport'])->name('raport-calon-santri');

Route::get('data-santri/detail/{id}', [SantriController::class, 'detail'])->name('data-santri.detail');
Route::get('alumni/cetak-laporan-tahunan', [SantriController::class, 'cetakLaporan'])->name('alumni.cetakLaporan');
Route::get('laporan-tahunan-santri-wustho', [SantriController::class, 'raport_wustho'])->name('raport-santri-wustho');
Route::get('laporan-tahunan-santri-ulya', [SantriController::class, 'raport_ulya'])->name('raport-santri-ulya');
Route::get('laporan-tahunan-santri-takhosus', [SantriController::class, 'raport_takhosus'])->name('raport-santri-takhosus');
Route::get('laporan-tahunan-santri-idad', [SantriController::class, 'raport_idad'])->name('raport-santri-idad');

Route::get('lihat-laporan/{filename}', [SantriController::class, 'lihatLaporan'])->name('lihat-laporan');
