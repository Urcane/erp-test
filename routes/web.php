<?php

use App\Http\Controllers\Sales\Customer\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Sales\Opportunity\Survey\SurveyController;
use App\Http\Controllers\ProjectManagement\ProjectManagementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HC\Attendance\AttendanceController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Profile\PersonalController;
use App\Http\Controllers\Profile\FileController;
use App\Http\Controllers\Profile\TimeManagementController;
use App\Http\Controllers\HC\Settings;
use App\Http\Controllers\Request;

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
            Route::get('/list', 'index')->name('hc.att.index');
            Route::get('/list/{id}', 'show')->name('hc.att.detail');

            Route::put('/attendances', 'update')->name('hc.att.edit');
            Route::delete('/attendances', 'destroy')->name('hc.att.delete');

            Route::get('/summaries', 'getAttendanceSummaries')->name('hc.att.all-summaries');
            Route::get('/summaries/user', 'getAttendanceSummariesById')->name('hc.att.user-summaries');

            Route::get('/get-data/table/attendance', 'getTableAttendance')->name('hc.att.get-table-attendance');
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
            Route::post('/update/employee/employment', 'updateEmployment')->name('hc.emp.update.employment');
            Route::post('/update/employee/salary', 'updateSalary')->name('hc.emp.update.salary');
            Route::post('/update/employee/bank', 'updateBank')->name('hc.emp.update.bank');
            Route::post('/update/employee/tax', 'updateTax')->name('hc.emp.update.tax');
            Route::post('/update/employee/bpjs', 'updateBpjs')->name('hc.emp.update.bpjs');

            Route::post('/store/employee', 'store')->name('hc.emp.store');
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

    Route::prefix('setting-company')->group(function () {
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

    Route::prefix('setting-time-management')->group(function () {
        Route::controller(Settings\TimeManagement\AttendanceController::class)->group(function () {
            Route::prefix('attendance')->group(function () {
                Route::get('/', 'index')->name('hc.setting.schedule.index');
                Route::get('/table/schedule', 'getTableSchedule')->name('hc.setting.getTableSchedule');
                Route::post('/create/update', 'createUpdate')->name('hc.setting.schedule.createUpdate');
                Route::post('/delete', 'delete')->name('hc.setting.schedule.delete');
                Route::post('/get/shift', 'getShift')->name('hc.setting.schedule.get.shift');
            });
        });
    });

    Route::prefix('cmt-request')->group(function () {
        Route::controller(Request\AttendanceController::class)->group(function () {
            Route::prefix('/attendance')->group(function () {
                Route::post('/create', 'makeRequest')->name('req.attd.create');
                Route::get('/get-data/table/me', 'showAllRequestTable')->name('req.attd.get-table-me');
            });
        });
    });

    Route::controller(TimeManagementController::class)->group(function () {
        Route::prefix('cmt-employee-time-management')->group(function () {
            Route::get('/get-data/table/request/attendance', 'getRequestAttendance')->name('hc.emp.get-table-request-attendance');
            Route::get('/get-data/table/request/shift', 'getRequestShift')->name('hc.emp.get-table-request-shift');
            Route::get('/get-data/table/request/overtime', 'getRequestOvertime')->name('hc.emp.get-table-request-overtime');
            Route::get('/get-data/table/request/timeof', 'getRequestTimeOf')->name('hc.emp.get-table-request-timeoff');
        });
    });
});

require __DIR__ . '/auth.php';
