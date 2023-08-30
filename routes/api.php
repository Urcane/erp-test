<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;
use App\Http\Controllers\Profile\PersonalController;

use App\Http\Controllers\Api\HC;
use App\Http\Controllers\Api\Request;


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

Route::controller(Api\UserController::class)->group(function () {
    Route::post('/login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('user')->group(function () {
        Route::controller(Api\UserController::class)->group(function () {
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
        Route::prefix('attendance')->group(function () {
            Route::controller(HC\Request\AttendanceController::class)->group(function () {
                Route::post('/get', 'getRequest');
            });
        });

        // Route::prefix('shift')->group(function () {
        //     Route::controller(HC\Request\ShiftController::class)->group(function () {
        //         Route::post('/get', 'getRequest');
        //     });
        // });

        Route::prefix('personal')->group(function () {
            Route::prefix('attendance')->group(function () {
                Route::controller(Request\AttendanceController::class)->group(function () {
                    Route::post('/get', 'getRequest');
                    Route::post('/get/detail', 'getRequestById');

                    Route::post('/make', 'makeRequest');
                });
            });

            Route::prefix('shift')->group(function () {
                Route::controller(Request\ShiftController::class)->group(function () {
                    Route::post('/get', 'getRequest');
                    Route::post('/get/detail', 'getRequestById');

                    Route::post('/make', 'makeRequest');
                });
            });

            // Route::prefix('time-off')->group(function () {
            //     Route::controller(Request\TimeOffController::class)->group(function () {
            //         Route::post('/get', 'getRequest');
            //         Route::post('/get/detail', 'getRequestById');

            //         Route::post('/make', 'makeRequest');
            //     });
            // });
        });
    });
});
