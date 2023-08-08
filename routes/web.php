<?php

use App\Http\Controllers\Sales\Customer\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Sales\Opportunity\Survey\SurveyController;
use App\Http\Controllers\ProjectManagement\ProjectManagementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Profile\EmergencyContactController;
use App\Http\Controllers\Profile\FamilyController;

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
            Route::get('/', 'index')->name('hc.emp.index');

            Route::GET('/create/employee', 'create')->name('hc.emp.create');
            // Route::post('/store/employee','store')->name('hc.emp.store');
            Route::post('/update-status/employee', 'statusPegawai')->name('hc.emp.update-status');
            Route::post('/reset-password-pegawai/employee', 'resetPasswordPegawai')->name('hc.emp.reset-password-pegawai');

            Route::get('/get-data/table/employee', 'getTableEmployee')->name('hc.emp.get-table-employee');
        });
    });

    Route::controller(AttendanceController::class)->group(function () {
        Route::prefix('cmt-attendance')->group(function () {
            Route::get('/', 'index')->name('hc.att.index');
        });
    });

    Route::controller(CustomerController::class)->group(function () {
        Route::prefix('cmt-lead')->group(function () {
            Route::get('/', 'indexLead')->name('com.lead.index-lead');

            Route::post('store/lead', 'storeLead')->name('com.lead.store-lead');
            Route::post('update/lead', 'updateLead')->name('com.lead.update-lead');
            Route::post('tindak-lanjut/lead', 'tindakLanjutLead')->name('com.lead.tindak-lanjut-lead');
            Route::post('update/prospect', 'updateProspect')->name('com.lead.update-prospect');
            Route::post('batal/prospect', 'batalProspect')->name('com.lead.batal-prospect');

            Route::get('/get-data/edit/lead/{id}', 'getEditLead')->name('com.lead.get-edit-lead');
            Route::get('/get-data/table/lead', 'getTableLead')->name('com.lead.get-table-lead');
            Route::get('/get-data/table/prospect', 'getTableProspect')->name('com.prospect.get-table-prospect');
            Route::get('/get-data/table/prospect/done', 'getTableProspectDone')->name('com.prospect.get-table-prospect-only-done');
        });
    });

    Route::controller(ProjectManagementController::class)->group(function () {
        Route::prefix('cmt-promag')->group(function () {
            Route::get('/', 'index')->name('com.promag.index');
            Route::get('/detail', 'detail')->name('com.promag.detail');
            Route::get('/detail/files', 'files')->name('com.promag.detail.files');
            Route::get('/detail/task-lists', 'taskLists')->name('com.promag.detail.task-lists');

            Route::post('/work-order/store', 'createWorkOrderSurvey')->name('com.work-order-survey.store');
            Route::get('/work-order/detail/{id}', 'getWorkOrderById')->name('com.work-order.detail');
            Route::get('/get-data/table/work-order', 'getDatatableWorkOrder')->name('com.work-order.datatable');
        });
    });

    Route::controller(SurveyController::class)->group(function () {
        Route::prefix('cmt-survey')->group(function () {
            Route::get('/', 'index')->name('com.survey.index');
            Route::get('/detail/{id}', 'detail')->name('com.survey.detail');
            Route::get('/survey-request/detail/{id}', 'getSurveyRequestById')->name('com.survey-request.detail');
            Route::post('/survey-request', 'storeSurveyRequest')->name('com.survey-request.store');
            Route::post('/soft-survey', 'storeSoftSurvey')->name('com.soft-survey.store');
            Route::post('/survey-result', 'storeSurveyResult')->name('com.survey-result.store');

            Route::get('/get-data/table/survey-request', 'getDatatableSurveyRequest')->name('com.survey-request.datatable');
            Route::get('/get-data/table/survey-result', 'getDatatableSurveyResult')->name('com.survey-result.datatable');
        });
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::prefix('cmt-employee-profile')->group(function () {
            Route::get('/{id}/profile', 'profile')->name('hc.emp.profile');
            Route::post('/update/employee/personal', 'updatePersonal')->name('hc.emp.update.personal');
            Route::post('/update/employee/identity', 'updateIdentity')->name('hc.emp.update.identity');
            Route::post('/update/employee/employment', 'updateEmployment')->name('hc.emp.update.employment');
            Route::post('/update/employee/salary', 'updateSalary')->name('hc.emp.update.salary');
            Route::post('/update/employee/bank', 'updateBank')->name('hc.emp.update.bank');
            Route::post('/update/employee/tax', 'updateTax')->name('hc.emp.update.tax');
            Route::post('/update/employee/bpjs', 'updateBpjs')->name('hc.emp.update.bpjs');

            Route::post('/store/employee', 'store')->name('hc.emp.store');
        });
    });

    Route::controller(FamilyController::class)->group(function () {
        Route::prefix('cmt-employee-family')->group(function () {
            Route::get('/get-data/table/family', 'getTableFamily')->name('hc.emp.get-table-family');
        });
    });

    Route::controller(EmergencyContactController::class)->group(function () {
        Route::prefix('cmt-employee-emergency-contact')->group(function () {
            Route::get('/get-data/table/emergency/contact', 'getTableEmergencyContact')->name('hc.emp.get-table-emergency-contact');
        });
    });
});

require __DIR__ . '/auth.php';
