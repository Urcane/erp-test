<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sales\Opportunity\Quotation\QuotationController;
use App\Http\Controllers\Sales\Opportunity\BoQ\BoQController;
use App\Http\Controllers\Api;
use App\Http\Controllers\Profile\PersonalController;

use App\Http\Controllers\Api\HC;
use App\Http\Controllers\Api\Request;
use App\Http\Controllers\Tests;

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
        Route::get('/get-internet-bundling', 'getInternetBundling')->name('com.quotation.get.internet.bundling');
        Route::post('/update-internet-bundling', 'updateInternetBundling')->name('com.quotation.update.internet.bundling');
    });
});

Route::controller(Api\UserController::class)->group(function () {
    Route::post('/login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('user')->group(function () {
        Route::controller(Api\UserController::class)->group(function () {
            Route::get('/new-user/change-pass', 'changeFirstPassword');
            Route::get('/me', 'getUserProfile');
            Route::get('/personal/data', 'getUserPersonalData');
            Route::get('/employment/data', 'getUserEmploymentData');
            Route::get('/payroll/salary/data', 'getUserSalary');
            Route::get('/payroll/bank/data', 'getUserBank');
            Route::get('/payroll/tax/data', 'getUserTax');
            Route::get('/payroll/bpjs/data', 'getUserBpjs');
        });
        Route::controller(PersonalController::class)->group(function () {
            Route::post('/update/personal/data', 'updatePersonal');
        });
    });

    Route::controller(HC\EmployeeController::class)->group(function () {
        Route::prefix('cmt-employee')->group(function () {
            Route::get("/all", "getAllEmployee");
        });
    });

    Route::controller(Api\AttendanceController::class)->group(function () {
        Route::prefix('cmt-attendance')->group(function () {
            Route::get('/history', 'getAttendanceHistory');
            Route::post('/history/detail', 'getAttendanceByDate');

            Route::get('/summaries/me', 'getPersonalAttendanceSummaries');

            Route::post('/attend/location/validate', 'validateLocation');
            Route::post('/attend/check-in', 'checkIn');
            Route::post('/attend/check-out', 'checkOut');
        });
    });

    Route::prefix('cmt-request')->group(function () {
        Route::controller(Api\ShiftController::class)->group(function () {
            Route::get('/get/working-shift', 'getAllWorkingShift');
        });

        Route::controller(Request\TimeOffController::class)->group(function () {
            Route::get('/get/category', 'getCategories');
        });

        Route::middleware(['permission:Approval:view-request|HC:view-all-request'])->group(function () {
            Route::prefix('attendance')->group(function () {
                Route::controller(HC\Request\AttendanceController::class)->group(function () {
                    Route::post('/get', 'getRequests');
                    Route::post('/get/detail', 'getRequestById');

                    Route::post('/update/status', 'updateRequestStatusById')
                        ->middleware(['permission:Approval:change-status-request|HC:change-all-status-request']);
                });
            });

            Route::prefix('shift')->group(function () {
                Route::controller(HC\Request\ShiftController::class)->group(function () {
                    Route::post('/get', 'getRequests');
                    Route::post('/get/detail', 'getRequestById');

                    Route::post('/update/status', 'updateRequestStatusById')
                        ->middleware(['permission:Approval:change-status-request|HC:change-all-status-request']);
                });

                Route::controller(Api\ShiftController::class)->group(function () {
                    Route::get('/get/working-shift', 'getAllWorkingShift');
                });
            });

            Route::prefix('time-off')->group(function () {
                Route::controller(HC\Request\TimeOffController::class)->group(function () {
                    Route::post('/get', 'getRequests');
                    Route::post('/get/detail', 'getRequestById');

                    Route::post('/update/status', 'updateRequestStatusById')
                        ->middleware(['permission:Approval:change-status-request|HC:change-all-status-request']);
                });
            });
        });

        Route::prefix('personal')->group(function () {
            Route::prefix('attendance')->group(function () {
                Route::controller(Request\AttendanceController::class)->group(function () {
                    Route::post('/get', 'getRequest');
                    Route::post('/get/detail', 'getRequestById');

                    Route::post('/make', 'makeRequest');
                    Route::post('/cancel', 'cancelRequest');
                });
            });

            Route::prefix('shift')->group(function () {
                Route::controller(Request\ShiftController::class)->group(function () {
                    Route::post('/get', 'getRequest');
                    Route::post('/get/detail', 'getRequestById');
                    Route::get('/get/current/shift', 'getCurrentShift');

                    Route::post('/make', 'makeRequest');
                    Route::post('/cancel', 'cancelRequest');
                });
            });

            Route::prefix('time-off')->group(function () {
                Route::controller(Request\TimeOffController::class)->group(function () {
                    Route::post('/get', 'getRequest');
                    Route::post('/get/detail', 'getRequestById');

                    Route::post('/make', 'makeRequest');
                    Route::post('/cancel', 'cancelRequest');
                });
            });
        });
    });
});
