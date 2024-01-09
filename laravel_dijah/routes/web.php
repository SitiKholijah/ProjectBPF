<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\AkunController;

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

Route::get('/', function () {
    return view('customer.index');
});
// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('makanan', MakananController::class);

Route::get('/SanjaySaiyo', [MakananController::class, 'indexCust'])->name('home');
Route::get('/Keripik', [MakananController::class, 'custkategori1'])->name('kategori1');
Route::get('/Snack', [MakananController::class, 'custkategori2'])->name('kategori2');
Route::get('/Kue', [MakananController::class, 'custkategori3'])->name('kategori3');

Route::get('/AdminSanjaySaiyo', [MakananController::class, 'index'])->name('homeAdmin');
Route::get('/kategoriKeripik', [MakananController::class, 'kategori1'])->name('makanan.kategori1');
Route::get('/kategoriSnack', [MakananController::class, 'kategori2'])->name('makanan.kategori2');
Route::get('/kategoriKue', [MakananController::class, 'kategori3'])->name('makanan.kategori3');

Route::get('/FormRegistrasi', [AkunController::class, 'showFormRegistrasi'])->name('akun.registrasi');
Route::post('/registrasi', [AkunController::class, 'registrasi'])->name('regis');

Route::get('/FormLogin', [AkunController::class, 'showFormLogin'])->name('akun.login');
Route::post('/login', [AkunController::class, 'login'])->name('login');

