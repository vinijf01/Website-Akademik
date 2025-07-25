<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PraPendaftaranController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'beranda'])->name('beranda');

// Parent & Walas Login
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LogoutController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::controller(UserController::class)->group(function () {
    Route::get('/', 'beranda')->name('beranda');
    Route::get('/visi-misi', 'visi_misi')->name('visi.misi');
    Route::get('/ppdb', 'ppdb')->name('ppdb');
    Route::get('/formulir-prapendaftaran', 'formulir_prapendaftaran')->name('formulir_prapendaftaran');
    Route::get('/formulir-pendaftaran', 'formulir_pendaftaran')->name('formulir_pendaftaran');
    Route::get('/404', 'pengembangan')->name('404');
    Route::get('/yayasan', 'yayasan')->name('yayasan');
    Route::get('/pesantren', 'sekolah')->name('sekolah');
    Route::get('/program-akademik/{id}', 'program_akademik')->name('program-akademik');
    Route::get('/berita', 'berita')->name('berita');
    Route::get('/detail-berita/{id}', 'detail_berita')->name('detail-berita');
    Route::get('/search-berita', 'search')->name('search-berita');
    Route::get('/galeri', 'galeri')->name('galeri');
    Route::get('/fasilitas', 'fasilitas')->name('fasilitas');
    Route::get('/kontak', 'kontak')->name('kontak');
});

Route::resource('/pendaftaran', PendaftaranController::class);
Route::resource('/pra-pendaftaran', PraPendaftaranController::class);

// Route::get('/api/documentation', [
//     'as' => 'l5-swagger.default.api',
//     'uses' => '\L5Swagger\Http\Controllers\SwaggerController@api',
// ]);

Route::get('/api/documentation', [
    'as' => 'l5-swagger.default.api',
    'uses' => '\L5Swagger\Http\Controllers\SwaggerController@api',
    'middleware' => config('l5-swagger.routes.middleware.api', []),
])->defaults('documentation', 'default');
