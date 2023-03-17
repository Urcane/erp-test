<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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
            Route::post('/store/employee','storeEmployee')->name('hc.emp.store');
            
            Route::get('/get-data/table/employee','getTableEmployee')->name('hc.emp-get-table-employee');
        });
    });
    
});

require __DIR__ . '/auth.php';
