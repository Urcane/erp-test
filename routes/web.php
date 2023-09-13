<?php

use App\Http\Controllers\Sales\Customer\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Sales\Opportunity\Survey\SurveyController;
use App\Http\Controllers\ProjectManagement\ProjectManagementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Profile\PersonalController;
use App\Http\Controllers\Profile\FileController;

use App\Http\Controllers\Request;

use App\Http\Controllers\HC\Attendance;
use App\Http\Controllers\HC\Employee\EmployeeController;
use App\Http\Controllers\HC\Settings;
use App\Http\Controllers\HC\Request as HCRequest;

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

    Route::middleware(['permission:HC:view-employee'])->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::prefix('cmt-employee')->group(function () {
                Route::get('/', 'index')->name('hc.emp.index');

                Route::get('/create/employee', 'create')->name('hc.emp.create');
                Route::post('/update-status/employee', 'statusPegawai')->name('hc.emp.update-status');
                Route::post('/reset-password-pegawai/employee', 'resetPasswordPegawai')->name('hc.emp.reset-password-pegawai');

                Route::get('/get-data/table/employee', 'getTableEmployee')->name('hc.emp.get-table-employee');
            });
        });
    });

    Route::middleware(['permission:HC:view-employee'])->group(function () {
        Route::controller(EmployeeController::class)->group(function () {
            Route::prefix('cmt-employee')->group(function () {
                Route::post('/store/employee', 'store')->name('hc.emp.store');
            });
        });
    });

    Route::controller(Attendance\AttendanceController::class)->group(function () {
        Route::prefix('cmt-attendance')->group(function () {
            Route::middleware(['permission:HC:view-attendance'])->group(function () {
                Route::get('/list', 'index')->name('hc.att.index');

                Route::get('/summaries', 'getAttendanceSummaries')->name('hc.att.all-summaries');
                Route::get('/get-data/table/summaries', 'getAttendanceSummariesTable')->name('hc.att.get-table-attendance-summaries');
                Route::get('/get-data/table/attendance', 'getTableAttendance')->name('hc.att.get-table-attendance');
                Route::get('/export/all', 'exportAllAttendance')->name('hc.att.export.all');
            });

            Route::middleware(['permission:HC:edit-delete-attendance'])->group(function () {
                Route::put('/attendances', 'update')->name('hc.att.edit');
                Route::delete('/attendances', 'destroy')->name('hc.att.delete');
            });

            Route::get('/list/{id}', 'show')->name('hc.att.detail');
            Route::get('/export/personal', 'exportPersonalAttendance')->name('hc.att.export.personal');
            Route::get('/summaries/user', 'getAttendanceSummariesById')->name('hc.att.user-summaries');
            Route::get('/get-data/table/attendance/detail', 'getTableAttendanceDetail')->name('hc.att.get-table-attendance-detail');
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

            Route::middleware(['permission:HC:update-profile'])->group(function () {
                Route::post('/update/employee/employment', 'updateEmployment')->name('hc.emp.update.employment');
                Route::post('/update/employee/salary', 'updateSalary')->name('hc.emp.update.salary');
                Route::post('/update/employee/bank', 'updateBank')->name('hc.emp.update.bank');
                Route::post('/update/employee/tax', 'updateTax')->name('hc.emp.update.tax');
                Route::post('/update/employee/bpjs', 'updateBpjs')->name('hc.emp.update.bpjs');
            });
        });
    });

    Route::controller(PersonalController::class)->group(function () {
        Route::prefix('cmt-employee-personal')->group(function () {
            // family
            Route::get('/get-data/table/family', 'getTableFamily')->name('hc.emp.get-table-family');
            Route::post('/createUpdate/employee/family', 'createUpdateFamily')->name('hc.emp.create-update-family');
            Route::post('/delete/employee/family', 'deleteFamily')->name('hc.emp.delete-family');

            // emergency contact
            Route::get('/get-data/table/emergency/contact', 'getTableEmergencyContact')->name('hc.emp.get-table-emergency-contact');
            Route::post('/createUpdate/employee/emergency/contact', 'createUpdateEmergencyContact')->name('hc.emp.create-update-emergency-contact');
            Route::post('/delete/employee/emergency/contact', 'deleteEmergencyContact')->name('hc.emp.delete-emergency-contact');

            // formal education
            Route::get('/get-data/table/education/formal', 'getTableFormalEducation')->name('hc.emp.get-table-formal-education');
            Route::post('/createUpdate/employee/education/formal', 'createUpdateFormalEducation')->name('hc.emp.create-update-formal-education');
            Route::post('/delete/employee/education/formal', 'deleteFormalEducation')->name('hc.emp.delete-formal-education');

            // non formal education
            Route::get('/get-data/table/education/nonformal', 'getTableNonFormalEducation')->name('hc.emp.get-table-non-formal-education');
            Route::post('/createUpdate/employee/education/non/formal', 'createUpdateNonFormalEducation')->name('hc.emp.create-update-non-formal-education');
            Route::post('/delete/employee/education/non/formal', 'deleteNonFormalEducation')->name('hc.emp.delete-non-formal-education');

            //  work experience
            Route::get('/get-data/table/experience', 'getTableExperience')->name('hc.emp.get-table-experience');
            Route::post('/createUpdate/employee/work/experience', 'createUpdateWorkExperience')->name('hc.emp.create-update-work-experience');
            Route::post('/delete/employee/work/experience', 'deleteWorkExperience')->name('hc.emp.delete-work-experience');

            Route::post('/update/employee/personal', 'updatePersonal')->name('hc.emp.update.personal');
            Route::post('/update/employee/identity', 'updateIdentity')->name('hc.emp.update.identity');
        });
    });

    Route::controller(FileController::class)->group(function () {
        Route::prefix('cmt-employee-file')->group(function () {
            //  user file
            Route::get('/get-data/table/user-file', 'getTableUserFile')->name('hc.emp.get-table-user-file');
            Route::post('/createUpdate/employee/user-file', 'createUpdateUserFile')->name('hc.emp.create-update-user-file');
            Route::post('/delete/employee/user-file', 'deleteUserFile')->name('hc.emp.delete-user-file');
            Route::post('/delete/employee/user-file/download', 'download')->name('hc.emp.profile.file.download');
        });
    });

    Route::middleware(['permission:HC:setting'])->group(function () {
        Route::prefix('setting')->group(function () {
            Route::prefix('company')->group(function () {
                Route::controller(Settings\Company\CompanyInfoController::class)->group(function () {
                    Route::prefix('company-info')->group(function () {
                        Route::get('/', 'index')->name('hc.setting.company-info.index');
                        Route::post('/update', 'update')->name('hc.setting.company-info.update');
                    });
                });
                Route::controller(Settings\Company\BranchController::class)->group(function () {
                    Route::prefix('branch')->group(function () {
                        Route::get('/', 'index')->name('hc.setting.branch.index');
                        Route::get('/table/branch', 'getTableBranch')->name('hc.emp.getTableBranch');
                        Route::get('/create', 'create')->name('hc.setting.branch.create');
                        Route::get('/edit/{id}', 'edit')->name('hc.setting.branch.edit');
                        Route::post('/create/update', 'createUpdate')->name('hc.setting.branch.createUpdate');
                        Route::post('/delete', 'delete')->name('hc.setting.branch.delete');
                    });
                });
                Route::controller(Settings\Company\OrganizationController::class)->group(function () {
                    Route::prefix('organization')->group(function () {
                        Route::get('/', 'index')->name('hc.setting.organization.index');
                        Route::get('/table/organization', 'getTableOrganization')->name('hc.emp.getTableOrganization');
                        Route::post('/create/update', 'createUpdate')->name('hc.setting.organization.createUpdate');
                        Route::post('/delete', 'delete')->name('hc.setting.organization.delete');
                    });
                });
                Route::controller(Settings\Company\JobLevelController::class)->group(function () {
                    Route::prefix('job-level')->group(function () {
                        Route::get('/', 'index')->name('hc.setting.job-level.index');
                        Route::get('/table/job-level', 'getTableJobLevel')->name('hc.emp.getTableJobLevel');
                        Route::post('/create/update', 'createUpdate')->name('hc.setting.job-level.createUpdate');
                        Route::post('/delete', 'delete')->name('hc.setting.job-level.delete');
                    });
                });
                Route::controller(Settings\Company\JobPositionController::class)->group(function () {
                    Route::prefix('job-position')->group(function () {
                        Route::get('/', 'index')->name('hc.setting.job-position.index');
                        Route::get('/table/job-position', 'getTableJobPosition')->name('hc.emp.getTableJobPosition');
                        Route::post('/create/update', 'createUpdate')->name('hc.setting.job-position.createUpdate');
                        Route::post('/delete', 'delete')->name('hc.setting.job-position.delete');
                    });
                });
                Route::controller(Settings\Company\EmploymentStatusController::class)->group(function () {
                    Route::prefix('employment-status')->group(function () {
                        Route::get('/', 'index')->name('hc.setting.employment-status.index');
                        Route::get('/table/employment-status', 'getTableEmploymentStatus')->name('hc.emp.getTableEmploymentStatus');
                        Route::post('/create/update', 'createUpdate')->name('hc.setting.employment-status.createUpdate');
                        Route::post('/delete', 'delete')->name('hc.setting.employment-status.delete');
                    });
                });
                Route::controller(Settings\Company\FileCategoryController::class)->group(function () {
                    Route::prefix('file-category')->group(function () {
                        Route::get('/', 'index')->name('hc.setting.file-category.index');
                        Route::get('/table/file-category', 'getTableUserFileCategory')->name('hc.emp.getTableUserFileCategory');
                        Route::post('/create/update', 'createUpdate')->name('hc.setting.file-category.createUpdate');
                        Route::post('/delete', 'delete')->name('hc.setting.file-category.delete');
                    });
                });
            });

            Route::prefix('users')->group(function () {
                Route::controller(Settings\Users\PermissionController::class)->group(function () {
                    Route::prefix('permission')->group(function () {
                        Route::get('/', 'index')->name('hc.setting.permission.index');
                        Route::get('/table/permission', 'getTableSchedule')->name('hc.setting.permission.getTable');
                        Route::get('/detail/user/{user}', 'detailUserPermission')->name('hc.setting.permission.detailUser');
                        Route::post('/assign/user/{user}', 'assignPermission')->name('hc.setting.permission.assignPermission');
                    });
                });
            });

            Route::prefix('time-management')->group(function () {
                Route::controller(Settings\TimeManagement\AttendanceController::class)->group(function () {
                    Route::prefix('attendance')->group(function () {
                        Route::get('/', 'index')->name('hc.setting.schedule.index');
                        Route::get('/table/schedule', 'getTableSchedule')->name('hc.setting.getTableSchedule');
                        Route::post('/create/update/schedule', 'createUpdateSchedule')->name('hc.setting.schedule.createUpdate');
                        Route::post('/delete/schedule', 'deleteSchedule')->name('hc.setting.schedule.delete');
                        Route::post('/get/shift', 'getShift')->name('hc.setting.schedule.get.shift');

                        Route::get('/table/shift', 'getTableShift')->name('hc.setting.getTableShift');
                        Route::post('/create/update/shift', 'createUpdateShift')->name('hc.setting.shift.createUpdate');
                        Route::post('/delete/shift', 'deleteShift')->name('hc.setting.shift.delete');
                        Route::post('/create/update/shift/show/in/request', 'udpateShowInRequest')->name('hc.setting.shift.udpateShowInRequest');
                    });
                });

                Route::controller(Settings\TimeManagement\LiveLocationController::class)->group(function () {
                    Route::prefix('live-location')->group(function () {
                        Route::get('/', 'index')->name('hc.setting.live-location.index');
                        Route::get('/table', 'getTable')->name('hc.setting.live-location.getTable');
                        Route::get('/detail/branch/location/{branch}', 'detailBranchLocation')->name('hc.setting.live-location.detailBranchLocation');
                        Route::get('/table/location/{branchId}', 'getTableLocation')->name('hc.setting.live-location.getTableLocation');

                        Route::post('/create/update/{branchId}', 'createUpdate')->name('hc.setting.live-location.createUpdate');
                        Route::post('/delete', 'destroy')->name('hc.setting.live-location.delete');
                    });
                });

                Route::controller(Settings\TimeManagement\TimeOffController::class)->group(function () {
                    Route::prefix('time-off')->group(function () {
                        Route::get('/', 'index')->name('hc.setting.timeoff.index');
                        Route::get('/table', 'getTable')->name('hc.setting.timeoff-get-table');
                        Route::post('/delete', 'destroy')->name('hc.setting.timeoff.delete');

                        Route::get('/create', 'create')->name('hc.setting.timeoff.create');
                        Route::post('/store', 'store')->name('hc.setting.timeoff.store');
                    });
                });

                Route::controller(Settings\TimeManagement\HolidayController::class)->group(function () {
                    Route::prefix('holiday')->group(function () {
                        Route::get('/', 'index')->name('hc.setting.holiday.index');
                        Route::get('/table', 'getTable')->name('hc.setting.holiday-get-table');
                        Route::post('/create/update', 'createUpdate')->name('hc.setting.holiday.createUpdate');
                        Route::post('/delete', 'destroy')->name('hc.setting.holiday.delete');
                    });
                });
            });
        });
    });

    Route::prefix('cmt-request')->group(function () {
        Route::middleware(['permission:Approval:view-request|HC:view-all-request'])->group(function () {
            Route::controller(HCRequest\IndexController::class)->group(function () {
                Route::get('/list', 'index')->name('hc.request.index');
            });

            Route::prefix('attendance')->group(function () {
                Route::controller(HCRequest\AttendanceController::class)->group(function () {
                    Route::get('/get-data/summaries', 'getSummaries')->name('hc.request.att.summaries');
                    Route::get('/get-data/table', 'getTable')->name('hc.request.att.get-table');

                    Route::put('/update/status', 'updateRequestStatus')
                        ->middleware(['permission:Approval:change-status-request|HC:change-all-status-request'])
                        ->name('hc.request.att.update');
                });
            });

            Route::prefix('shift')->group(function () {
                Route::controller(HCRequest\ShiftController::class)->group(function () {
                    Route::get('/get-data/summaries', 'getSummaries')->name('hc.request.shf.summaries');
                    Route::get('/get-data/table', 'getTable')->name('hc.request.shf.get-table');

                    Route::put('/update/status', 'updateRequestStatus')
                        ->middleware(['permission:Approval:change-status-request|HC:change-all-status-request'])
                        ->name('hc.request.shf.update');
                });
            });

            Route::prefix('time-off')->group(function () {
                Route::controller(HCRequest\TimeOffController::class)->group(function () {
                    Route::get('/get-data/summaries', 'getSummaries')->name('hc.request.tmoff.summaries');
                    Route::get('/get-data/table', 'getTable')->name('hc.request.tmoff.get-table');

                    Route::put('/update/status', 'updateRequestStatus')
                        ->middleware(['permission:Approval:change-status-request|HC:change-all-status-request'])
                        ->name('hc.request.tmoff.update');
                });
            });
        });

        Route::prefix('personal')->group(function () {
            Route::controller(Request\AttendanceController::class)->group(function () {
                Route::prefix('/attendance')->group(function () {
                    Route::post('/create', 'makeRequest')->name('req.attd.create');
                    Route::put('/cancel', 'cancelRequest')->name('req.attd.cancel');
                    Route::get('/get-data/table/me', 'showRequestTableById')->name('req.attd.get-table-me');
                });
            });

            Route::controller(Request\ShiftController::class)->group(function () {
                Route::prefix('/shift')->group(function () {
                    Route::post('/create', 'makeRequest')->name('req.shift.create');
                    Route::put('/cancel', 'cancelRequest')->name('req.shift.cancel');
                    Route::get('/get-data/table/me', 'showRequestTableById')->name('req.shift.get-table-me');
                });
            });

            Route::controller(Request\TimeOffController::class)->group(function () {
                Route::prefix('/time-off')->group(function () {
                    Route::post('/create', 'makeRequest')->name('req.time-off.create');
                    Route::put('/cancel', 'cancelRequest')->name('req.time-off.cancel');
                    Route::get('/get-data/table/me', 'showRequestTableById')->name('req.time-off.get-table-me');
                });
            });
        });
    });
});

require __DIR__ . '/auth.php';
