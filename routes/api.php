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
        Route::post('/store-data-boq','saveAndStoreBoq')->name('com.boq.store.boq');
        Route::post('/create-revision-boq','createRevisionBoq')->name('com.boq.revision.boq');
        Route::get('/update-draft-boq','updateDraftBoq')->name('com.boq.update-draft-boq');
        Route::get('/create-draft-boq','createDraftBoq')->name('com.boq.create-draft-boq');

    });
});
