<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HC\AttendanceController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\HC\EmployeeController;

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

Route::controller(UserController::class)->group(function () {
    Route::post('/login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('/me', 'getUserProfile');
        });
    });

    Route::controller(EmployeeController::class)->group(function () {
        Route::prefix('cmt-employee')->group(function () {
            Route::get("/all", "getAllEmployee");
        });
    });
    Route::controller(AttendanceController::class)->group(function () {
        Route::prefix('cmt-attendance')->group(function () {
            Route::get('/history', 'getAttendanceHistory');
            Route::get('/history/detail', 'getAttendanceByDate');

            Route::get('/summaries/me', 'getPersonalAttendanceSummaries');

            Route::post('/attend/location/validate', 'validateLocation');
            Route::post('/attend/check-in', 'checkIn');
            Route::post('/attend/check-out', 'checkOut');
        });
    });
});
