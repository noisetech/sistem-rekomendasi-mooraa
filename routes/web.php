<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\KategoriController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    // kategori
    Route::get('kategori', [KategoriController::class, 'index'])
        ->name('kategori');
    Route::get('kategori.data', [KategoriController::class, 'data'])
        ->name('kategori.data');
    Route::get('kategori/tambah', [KategoriController::class, 'tambah'])
        ->name('kategori.tambah');
    Route::post('kategori.simpan', [KategoriController::class, 'simpan'])
        ->name('kategori.simpan');
    Route::get('kategori/edit/{id}', [KategoriController::class, 'edit'])
        ->name('kategori.edit');
    Route::post('kategori.update', [KategoriController::class, 'update'])
        ->name('kategori.update');
    Route::post('kategori.hapus', [KategoriController::class, 'hapus'])
        ->name('kategori.hapus');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
