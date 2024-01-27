<?php

use App\Http\Controllers\AkunController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
    return view('form');
});

Auth::routes();

Route::group(['prefix' => 'dashboard/admin'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [HomeController::class, 'profile'])->name('profile');
        Route::post('update', [HomeController::class, 'updateprofile'])->name('profile.update');
    });

    Route::controller(AkunController::class)
        ->prefix('akun')
        ->as('akun.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('showdata', 'dataTable')->name('dataTable');
            Route::match(['get','post'],'tambah', 'tambahAkun')->name('add');
            Route::match(['get','post'],'{id}/ubah', 'ubahAkun')->name('edit');
            Route::delete('{id}/hapus', 'hapusAkun')->name('delete');
        });
});

use App\Http\Controllers\SimpatisanController;

Route::middleware(['web'])->group(function () {

// Route untuk simpatisan (hanya dapat diakses oleh user yang telah login)
Route::get('/simpatisan/form', [SimpatisanController::class, 'createForm'])->name('simpatisan.form');
Route::post('/simpatisan/store', [SimpatisanController::class, 'store'])->name('simpatisan.store');
Route::get('/simpatisan/view', [SimpatisanController::class, 'viewData'])->name('simpatisan.view');
Route::get('/export-simpatisan', [SimpatisanController::class, 'export'])->name('export.simpatisan');
Route::get('/simpatisan/form', [SimpatisanController::class, 'createForm'])->name('simpatisan.form');
Route::post('/simpatisan/store', [SimpatisanController::class, 'store'])->name('simpatisan.store');
Route::get('/export', [SimpatisanController::class, 'export']);
    
// Rute untuk mendapatkan data kabupaten, kecamatan, dan desa
Route::get('/get-kabupaten/{province_code}', [SimpatisanController::class, 'getKabupaten']);
Route::get('/get-kecamatan/{city_code}', [SimpatisanController::class, 'getKecamatan']);
Route::get('/get-desa/{district_code}', [SimpatisanController::class, 'getDesa']);

});
