<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\KonsultasiController;

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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::resource('penyakit', PenyakitController::class);

Route::resource('gejala', GejalaController::class);

Route::resource('rule', RuleController::class);

Route::resource('konsultasi', KonsultasiController::class);

Route::post('/konsultasi', [KonsultasiController::class, 'konsultasi']);

Route::get('/', [KonsultasiController::class, 'toHome']);




Auth::routes();

Route::get('/konsultasi', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
