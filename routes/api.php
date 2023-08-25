<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;
use App\Http\Controllers\Api\Request\AttendanceController;
use App\Http\Controllers\Api\HC\EmployeeController;

use App\Http\Controllers\Profile\PersonalController;

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
        });
        Route::controller(PersonalController::class)->group(function () {
            Route::post('/update/personal/data', 'updatePersonal');
        });
    });

    Route::controller(EmployeeController::class)->group(function () {
        Route::prefix('cmt-employee')->group(function () {
            Route::get("/all", "getAllEmployee");
        });
    });
    Route::controller(Api\HC\AttendanceController::class)->group(function () {
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
        Route::controller(AttendanceController::class)->group(function () {
            Route::post('/attendance/get', 'getRequestAttendance');
        });
        Route::controller(Api\Request\ShiftController::class)->group(function () {
            Route::post('/shift/get', 'getRequestShift');
        });
    });

    Route::controller(Api\HC\Request\AttendanceController::class)->group(function () {
        Route::prefix('cmt-approval')->group(function () {
            Route::post('/get', 'getApprovalAttendance');
        });
    });
});
