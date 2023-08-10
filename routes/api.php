<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sales\Opportunity\BoQ\BoQController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::controller(BoQController::class)->group(function () {
    Route::prefix('cmt-boq')->group(function (){
        Route::post('/form-boq','createNewBoQ')->name('com.boq.boq.store');
    });
});
