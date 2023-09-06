<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sales\Opportunity\Quotation\QuotationController;
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
        Route::post('/store-approval-boq','storeApprovalBoq')->name('com.boq.store.approval.boq');
        Route::post('/create-revision-boq','createRevisionBoq')->name('com.boq.revision.boq');
        Route::get('/update-draft-boq','updateDraftBoq')->name('com.boq.update-draft-boq');
        Route::get('/create-draft-boq','createDraftBoq')->name('com.boq.create-draft-boq');
    });
});

Route::controller(QuotationController::class)->group(function(){
    Route::prefix('cmt-quotation')->group(function(){
       Route::get('/', 'index')->name('com.quotation.index');
       Route::get('/get-data/table/data-result','getDatatable')->name('com.quotation.render.datatable');
       Route::get('/create-quotation','createQuotation')->name('com.quotation.create.quotation');
       Route::get('/update-quotation','updateQuotation')->name('com.quotation.update.quotation');
       Route::post('/store-data-quotation','saveAndStoreQuotation')->name('com.quotation.store.quotation');
       Route::post('/store-po-quotation','storePurchaseOrder')->name('com.quotation.store.quotation');
       Route::get('/get-internet-bundling', 'getInternetBundling')->name('com.quotation.get.internet.bundling');
       Route::post('/update-internet-bundling', 'updateInternetBundling')->name('com.quotation.update.internet.bundling');
    });
});
