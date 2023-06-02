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

            Route::post('store/lead','storeLead')->name('com.lead.store-lead');
            Route::post('update/lead','updateLead')->name('com.lead.update-lead');
            Route::post('tindak-lanjut/lead','tindakLanjutLead')->name('com.lead.tindak-lanjut-lead');
            Route::post('update/prospect','updateProspect')->name('com.lead.update-prospect');
            Route::post('batal/prospect','batalProspect')->name('com.lead.batal-prospect');

            Route::get('/get-data/edit/lead/{id}','getEditLead')->name('com.lead.get-edit-lead');
            Route::get('/get-data/table/lead','getTableLead')->name('com.lead.get-table-lead');
            Route::get('/get-data/table/prospect','getTableProspect')->name('com.prospect.get-table-prospect');
            
        });
    });

});

require __DIR__ . '/auth.php';
