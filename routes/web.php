<?php

use App\Http\Controllers\NeracaController;
use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return view('welcome');
});
// Login
Route::get('/login', [AuthController::class, 'login'])->name('simpanan.login');
Route::get('/log-out', [AuthController::class, 'logout'])->name('simpanan.logout');
Route::post('/post-login', [AuthController::class, 'postLogin'])->name('simpanan.postLogin');
Route::middleware(['auth'])->group(function () {
    // Home
    Route::get('/home', [NeracaController::class, 'home'])->name('simpanan.home');
    Route::post('/dataTahunHome', [NeracaController::class, 'dataTahunHome'])->name('simpanan.dataTahunHome');
    // Add Pemantau
    Route::get('/goToAddPemantau', [NeracaController::class, 'goToAddPemantau'])->name('simpanan.goToAddPemantau');
    Route::get('/updateDataUser{id}', [NeracaController::class, 'goToEditPemantau'])->name('user.edit');
    Route::post('/addUser', [NeracaController::class, 'addUser'])->name('user.add');
    Route::post('/editUser', [NeracaController::class, 'editUser'])->name('user.edit');
    Route::get('/deleteDataUser{id}', [NeracaController::class, 'deleteUser'])->name('user.delete');
    // Neraca Produksi
    Route::get('/neracaProduksi', [NeracaController::class, 'goToNProduksi'])->name("produksi.show");
    Route::post('/addProduksi', [NeracaController::class, 'NProduksiAdd'])->name("produksi.add");
    Route::post('/updateProduksi', [NeracaController::class, 'NProduksiUpdate'])->name("produksi.update");
    Route::get('/updateDataProduksi{id}', [NeracaController::class, 'NProduksiEdit'])->name("produksi.edit");
    Route::get('/deleteDataProduksi{id}', [NeracaController::class, 'NProduksiDelete'])->name("produksi.delete");
    // Neraca pengeluaran
    Route::get('/neracaPengeluaran', [NeracaController::class, 'goToNPengeluaran'])->name("pengeluaran.show");
    Route::post('/addPengeluaran', [NeracaController::class, 'NPengeluaranAdd'])->name("pengeluaran.add");
    Route::post('/updatePengeluaran', [NeracaController::class, 'NPengeluaranUpdate'])->name("pengeluaran.update");
    Route::get('/updateDataPengeluaran{id}', [NeracaController::class, 'NPengeluaranEdit'])->name("pengeluaran.edit");
    Route::get('/deleteDataPengeluaran{id}', [NeracaController::class, 'NPengeluaranDelete'])->name("pengeluaran.delete");
});
