<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Sales\ProspektusController;
use App\Http\Controllers\UserController;

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

Route::middleware(['auth'])->group(function () {
    
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });
    
    Route::controller(UserController::class)->group(function () {
        Route::prefix('cmt-employee')->group(function () {
            Route::get('/','index')->name('hc.emp.index');
            Route::get('/{id}/profile','profile')->name('hc.emp.profile');

            Route::post('/store/employee','store')->name('hc.emp.store');
            Route::post('/update/employee','update')->name('hc.emp.update');
            Route::post('/update-status/employee','statusPegawai')->name('hc.emp.update-status');
            Route::post('/reset-password-pegawai/employee','resetPasswordPegawai')->name('hc.emp.reset-password-pegawai');
            
            Route::get('/get-data/table/employee','getTableEmployee')->name('hc.emp.get-table-employee');
        });
    });

    Route::controller(CustomerController::class)->group(function () {
        Route::prefix('cmt-lead')->group(function () {
            Route::get('/','indexLead')->name('com.lead.index-lead');
        });
    });

});

require __DIR__ . '/auth.php';
