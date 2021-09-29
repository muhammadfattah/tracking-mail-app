<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EselonEmpatController;
use App\Http\Controllers\EselonTiga;
use App\Http\Controllers\EselonTigaController;
use App\Http\Controllers\KonseptorController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\PranataController;
use App\Http\Controllers\UserController;
use App\Models\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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


Route::middleware(['authMiddleware'])->group(function () {
    Route::get('', [AuthController::class, 'index']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::get('logout', [AuthController::class, 'logout']);


Route::middleware(['adminMiddleware'])->group(function () {
    Route::resource('user', UserController::class);

    Route::get('aktivitas', [MonitorController::class, 'index']);
    Route::get('aktivitas-data', [MonitorController::class, 'aktivitasData']);
    Route::get('user-online', [MonitorController::class, 'userOnline']);
});

Route::middleware(['userMiddleware'])->group(function () {

    Route::get('eselon-tiga', [EselonTigaController::class, 'index']);
    Route::get('eselon-tiga/terkirim', [EselonTigaController::class, 'index2']);
    Route::get('eselon-tiga/datatable', [EselonTigaController::class, 'datatable']);
    Route::get('eselon-tiga/datatable-terkirim', [EselonTigaController::class, 'datatableTerkirim']);
    Route::get('eselon-tiga/kirim', [EselonTigaController::class, 'kirim']);
    Route::get('eselon-tiga/{id}', [EselonTigaController::class, 'show']);
    Route::post('eselon-tiga', [EselonTigaController::class, 'store']);
    Route::delete('eselon-tiga/{id}/{jenis}', [EselonTigaController::class, 'destroy']);

    Route::get('eselon-empat', [EselonEmpatController::class, 'index']);
    Route::get('eselon-empat/terkirim', [EselonEmpatController::class, 'index2']);
    Route::get('eselon-empat/datatable', [EselonEmpatController::class, 'datatable']);
    Route::get('eselon-empat/datatable-terkirim', [EselonEmpatController::class, 'datatableTerkirim']);
    Route::get('eselon-empat/{id}', [EselonEmpatController::class, 'show']);
    Route::get('eselon-empat/kirim/{id}', [EselonEmpatController::class, 'kirim']);
    Route::post('eselon-empat', [EselonEmpatController::class, 'store']);
    Route::delete('eselon-empat/{id}/{jenis}', [EselonEmpatController::class, 'destroy']);

    Route::get('pranata', [PranataController::class, 'index']);
    Route::get('pranata/terkirim', [PranataController::class, 'index2']);
    Route::get('pranata/datatable', [PranataController::class, 'datatable']);
    Route::get('pranata/datatable-terkirim', [PranataController::class, 'datatableTerkirim']);
    Route::get('pranata/{id}', [PranataController::class, 'show']);
    Route::get('pranata/kirim/{id}', [PranataController::class, 'kirim']);
    Route::post('pranata', [PranataController::class, 'store']);
    Route::delete('pranata/{id}/{jenis}', [PranataController::class, 'destroy']);

    Route::get('konseptor', [KonseptorController::class, 'index']);
    Route::get('konseptor/terkirim', [KonseptorController::class, 'index2']);
    Route::get('konseptor/datatable', [KonseptorController::class, 'datatable']);
    Route::get('konseptor/datatable-terkirim', [KonseptorController::class, 'datatableTerkirim']);
    Route::get('konseptor/{id}', [KonseptorController::class, 'show']);
    Route::get('konseptor/kirim/{id}', [KonseptorController::class, 'kirim']);
    Route::post('konseptor', [KonseptorController::class, 'store']);
    Route::delete('konseptor/{id}/{jenis}', [KonseptorController::class, 'destroy']);


    Route::get('file/{id}', function ($id) {
        return Storage::download(File::find($id)->filename);
    });
});
