<?php

use App\Http\Controllers\Sales\Customer\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Sales\Opportunity\Survey\SurveyController;
use App\Http\Controllers\ProjectManagement\ProjectManagementController;
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
            Route::get('/get-data/table/prospect/done','getTableProspectDone')->name('com.prospect.get-table-prospect-only-done');
        });
    });

    Route::controller(ProjectManagementController::class)->group(function () {
        Route::prefix('cmt-promag')->group(function () {
            Route::get('/','index')->name('com.promag.index');
            Route::get('/detail','detail')->name('com.promag.detail');
            Route::get('/detail/files','files')->name('com.promag.detail.files');
            Route::get('/detail/task-lists','taskLists')->name('com.promag.detail.task-lists');

            Route::post('/work-order/store','createWorkOrderSurvey')->name('com.work-order-survey.store');
            Route::get('/get-data/table/work-order','getDatatableWorkOrder')->name('com.work-order.datatable');
        });

    });

    Route::controller(SurveyController::class)->group(function () {
        Route::prefix('cmt-survey')->group(function () {
            Route::get('/','index')->name('com.survey.index');
            Route::get('/detail/{id}','detail')->name('com.survey.detail');
            Route::post('/survey-request','storeSurveyRequest')->name('com.survey-request.store');
            Route::post('/survey-result','storeSurveyResult')->name('com.survey-result.store');
            
            Route::get('/get-data/table/survey-request','getDatatableSurveyRequest')->name('com.survey-request.datatable');
            Route::get('/get-data/table/survey-result','getDatatableSurveyResult')->name('com.survey-result.datatable');
        });
    });
});

require __DIR__ . '/auth.php';
