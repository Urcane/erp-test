<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Sales\Opportunity\Quotation\QuotationController;
use App\Http\Controllers\Sales\Customer\CustomerController;
use App\Http\Controllers\Sales\Opportunity\BoQ\BoQController;
use App\Http\Controllers\Sales\Procurement\ProcurementController;
use App\Http\Controllers\Sales\Opportunity\Survey\SurveyController;
use App\Http\Controllers\ProjectManagement\ProjectManagementController;
use App\Http\Controllers\Profile;

use App\Http\Controllers\Request;

use App\Http\Controllers\HC\Attendance;
use App\Http\Controllers\HC\Employee\EmployeeController;
use App\Http\Controllers\HC\Settings;
use App\Http\Controllers\HC\Request as HCRequest;

use App\Http\Controllers\Operation;
use App\Http\Controllers\Finance;
use App\Http\Controllers\ProjectManagement\TaskListController;

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
                Route::post('/import/employee', 'import')->name('hc.emp.import');
                Route::post('/get/schedule/shift', 'getScheduleShift')->name('hc.emp.get.schedule.shift');
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

    Route::prefix('cmt-promag')->group(function () {
        Route::controller(ProjectManagementController::class)->group(function () {
            Route::get('/', 'index')->name('com.promag.index');
            Route::get('/table', 'getWorkListTable')->name('com.promag.datatable');

            Route::get('/create', 'create')->name('com.promag.create');
            Route::post('/store', 'store')->name('com.promag.store');
            Route::get('/detail/{work_list_id}', 'detail')->name('com.promag.detail');
            Route::get('/detail/{work_list_id}/files', 'files')->name('com.promag.detail.files');


            Route::post('/work-order/approve', 'approveWorkOrder')->name('com.work-order.approve');
            Route::post('/work-order/store', 'createWorkOrderSurvey')->name('com.work-order-survey.store');
            Route::get('/work-order/detail/{work_list_id}', 'getWorkOrderById')->name('com.work-order.detail');
            Route::get('/get-data/table/work-order', 'getDatatableWorkOrder')->name('com.work-order.datatable');
            Route::get('/get-data/table/work-order-survey', 'getDataTableWorkOrderSurvey')->name('com.work-order-survey.datatable');
        });

        Route::controller(TaskListController::class)->group(function () {
            Route::get('/{work_list_id}/task-lists', 'taskLists')->name('com.promag.task-lists');
            Route::get('/{work_list_id}/task-lists/table', 'dataTableTaskList')->name('com.promag.task-list.datatable');
            Route::post('/{work_list_id}/task-lists/store', 'store')->name('com.promag.task-list.store');
            Route::get('/{work_list_id}/task-lists/detail/{task_list_id}', 'detailTaskList')->name('com.promag.task-list.detail');
            // Route::get('/{work_list_id}/task-lists/table', 'dataTableTaskList')->name('com.promag.task-list.datatable');
        });
    });

    Route::controller(SurveyController::class)->group(function () {
        Route::prefix('cmt-survey')->group(function () {
            Route::get('/', 'index')->name('com.survey.index');
            Route::get('/survey-request/detail/{id}', 'getSurveyRequestById')->name('com.survey-request.detail');
            Route::post('/survey-request', 'storeSurveyRequest')->name('com.survey-request.store');

            Route::get('/soft-survey', 'indexSoftSurvey')->name('com.soft-survey.index');
            Route::get('/soft-survey/{surveyRequest}', 'detailSoftSurvey')->name('com.soft-survey.detail');
            Route::post('/soft-survey', 'storeSoftSurvey')->name('com.soft-survey.store');

            Route::get('/survey-result-internet', 'indexSurveyResultInternet')->name('com.site-survey.internet.index');
            Route::get('/survey-result-cctv', 'indexSurveyResultCctv')->name('com.site-survey.cctv.index');
            Route::get('/survey-result-gb', 'indexSurveyResultGb')->name('com.site-survey.gb.index');
            Route::get('/survey-result-store/{workOrder}', 'createSurveyResult')->name('com.survey-result.create');
            Route::get('/detail/{serviceType}/{id}', 'detail')->name('com.survey.detail');
            Route::post('/survey-result-draft', 'draftSurveyResult')->name('com.survey-result.draft');
            Route::post('/survey-result-store', 'storeSurveyResult')->name('com.survey-result.store');

            Route::get('/survey-result-export/{serviceType}/{id}', 'exportSurveyResult')->name('com.survey-result.export');

            Route::get('/get-data/table/survey-request', 'getDatatableSurveyRequest')->name('com.survey-request.datatable');
            Route::get('/get-data/table/survey-result', 'getDatatableSurveyResult')->name('com.survey-result.datatable');
        });
    });

    Route::controller(Profile\ProfileController::class)->group(function () {
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

    Route::controller(Profile\PersonalController::class)->group(function () {
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

    Route::controller(Profile\LeaveController::class)->group(function () {
        Route::prefix('cmt-employee-personal')->group(function () {
            Route::get('/get-data/quotas', 'getUserLeaveQuotas')->name('hc.emp.get-user-leave-quotas');
            Route::get('/get-data/table/leave/history', 'getTableLeaveHistory')->name('hc.emp.get-table-leave-history');
            Route::get('/get-data/table/quota/history', 'getTableQuotaLeaveHistory')->name('hc.emp.get-table-quota-history');
        });
    });

    Route::controller(Profile\FileController::class)->group(function () {
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
                        Route::post('/delete/schedule/shift', 'deleteShiftFromSchedule')->name('hc.setting.schedule.delete.shift');
                        Route::post('/update/schedule/shift', 'updateShiftFromSchedule')->name('hc.setting.schedule.update.shift');
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

                        Route::get('/edit/{id}', 'edit')->name('hc.setting.timeoff.edit');
                        Route::post('/update', 'update')->name('hc.setting.timeoff.update');
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

    Route::prefix('operation')->group(function () {
        Route::controller(Operation\Assignment\AssignmentController::class)->group(function () {
            Route::prefix('assignment')->group(function () {
                Route::get('/', 'index')->name('opt.asign.index');
                Route::get('/create', 'create')->name('opt.asign.create');
                Route::post('/create', 'store')->name('opt.asign.store');
                Route::get('/detail/{id}', 'show')->name('opt.asign.detail');
                Route::get('/edit/{id}', 'edit')->name('opt.asign.edit');
                Route::post('/update', 'update')->name('opt.asign.update');
                Route::post('/cancel', 'cancel')->name('opt.asign.cancel');

                Route::post('/update-status', 'updateStatus')->name('opt.asign.update-status');

                Route::get('/get-data/table/data-result', 'getTableAssignment')->name('opt.asign.get-table-assignment');

                Route::get('/pdf/{assignment}/{user}', 'exportPdf')->name('opt.asign.export-pdf');
            });
        });
    });

    Route::prefix('finance')->group(function () {
        Route::prefix('inventory')->group(function () {
            Route::controller(Finance\Inventory\InventoryController::class)->group(function () {
                Route::get('/dashboard', 'viewDashboard')->name('fin.inv.dashboard');

                Route::prefix('inv')->group(function () {
                    Route::get('/', 'viewInventory')->name('fin.inv.inventory');

                    Route::get('/create', 'viewAddItem')->name('fin.inv.inventory-create');
                    Route::post('/create', 'storeItem')->name('fin.inv.inventory-create');
                    Route::get('/get-data/table/data-result', 'getTableInventory')->name('fin.inv.inventory-get-table-inventory');

                    Route::prefix('transfer')->group(function () {
                        Route::get('/', 'viewTransferItem')->name('fin.inv.inventory-transfer');
                        Route::post('/', 'transferItem')->name('fin.inv.inventory-transfer');
                        Route::get('/get-data/table/data-result/', 'getTableTransferItem')->name('fin.inv.inventory-get-table-transfer');
                    });
                });

                Route::prefix('logs')->group(function () {
                    Route::get('/', 'viewLogs')->name('fin.inv.logs');

                    Route::get('/get-data/table/data-result', 'getTableLogs')->name('fin.inv.logs-get-table-logs');
                });

                Route::prefix('master-data')->group(function () {
                    Route::get('/', 'viewMasterData')->name('fin.inv.master-data');

                    Route::prefix('warehouse')->group(function () {
                        Route::controller(Finance\Inventory\MasterData\WarehouseController::class)->group(function () {
                            Route::post('/create', 'create')->name('fin.inv.master-data.warehouse.create');
                            Route::post('/update', 'update')->name('fin.inv.master-data.warehouse.update');
                            Route::get('/data', 'getData')->name('fin.inv.master-data.warehouse.data');
                            Route::get('/get-data/table/warehouse', 'getTable')->name('fin.inv.master-data.warehouse.get-table');
                        });
                    });

                    Route::prefix('item')->group(function () {
                        Route::controller(Finance\Inventory\MasterData\ItemController::class)->group(function () {
                            Route::post('/create', 'create')->name('fin.inv.master-data.item.create');
                            Route::post('/update', 'update')->name('fin.inv.master-data.item.update');
                            Route::get('/data', 'getData')->name('fin.inv.master-data.item.data');
                            Route::get('/get-data/table/item', 'getTable')->name('fin.inv.master-data.item.get-table');
                        });
                    });

                    Route::prefix('category')->group(function () {
                        Route::controller(Finance\Inventory\MasterData\CategoryController::class)->group(function () {
                            Route::post('/create', 'create')->name('fin.inv.master-data.category.create');
                            Route::post('/update', 'update')->name('fin.inv.master-data.category.update');
                            Route::get('/data', 'getData')->name('fin.inv.master-data.category.data');
                            Route::get('/get-data/table/category', 'getTable')->name('fin.inv.master-data.category.get-table');
                        });
                    });

                    Route::prefix('unit')->group(function () {
                        Route::controller(Finance\Inventory\MasterData\UnitController::class)->group(function () {
                            Route::post('/create', 'create')->name('fin.inv.master-data.unit.create');
                            Route::post('/update', 'update')->name('fin.inv.master-data.unit.update');
                            Route::get('/data', 'getData')->name('fin.inv.master-data.unit.data');
                            Route::get('/get-data/table/unit', 'getTable')->name('fin.inv.master-data.unit.get-table');
                        });
                    });

                    Route::prefix('condition')->group(function () {
                        Route::controller(Finance\Inventory\MasterData\ConditionController::class)->group(function () {
                            Route::post('/create', 'create')->name('fin.inv.master-data.condition.create');
                            Route::post('/update', 'update')->name('fin.inv.master-data.condition.update');
                            Route::get('/data', 'getData')->name('fin.inv.master-data.condition.data');
                            Route::get('/get-data/table/condition', 'getTable')->name('fin.inv.master-data.condition.get-table');
                        });
                    });

                    Route::prefix('status')->group(function () {
                        Route::controller(Finance\Inventory\MasterData\StatusController::class)->group(function () {
                            Route::post('/create', 'create')->name('fin.inv.master-data.status.create');
                            Route::post('/update', 'update')->name('fin.inv.master-data.status.update');
                            Route::get('/data', 'getData')->name('fin.inv.master-data.status.data');
                            Route::get('/get-data/table/status', 'getTable')->name('fin.inv.master-data.status.get-table');
                        });
                    });
                });
            });
        });
    });

    Route::controller(BoQController::class)->group(function () {
        Route::prefix('cmt-boq')->group(function () {
            Route::get('/', 'index')->name('com.boq.index');
            Route::get('/get-data/table/data-result', 'getDatatable')->name('com.boq.render.datatable');

            Route::post('/batal-boq', 'batalBoQ')->name('com.boq.batal-boq');
            Route::get('/create-draft-boq', 'createDraftBoq')->name('com.boq.create-draft-boq');
            Route::get('/update-draft-boq', 'updateDraftBoq')->name('com.boq.update-draft-boq');
            Route::post('/create-revision-boq', 'createRevisionBoq')->name('com.boq.revision.boq');
            Route::get('/get-revision-boq', 'getApprovalBoq')->name('com.boq.get.revision.boq');
            Route::post('/store-data-boq', 'saveAndStoreBoq')->name('com.boq.store.boq');
            Route::post('/store-approval-boq', 'storeApprovalBoq')->name('com.boq.store.approval.boq');

            Route::get('/on-review-boq', 'onReviewBoq')->name('com.boq.on.review.boq');
            Route::get('/review-done-boq', 'reviewDoneBoq')->name('com.boq.review.done.boq');

            Route::get('/get-merk-type', 'getMerkType')->name('get.merk.type');
            Route::get('/get-survey-company-item-inventory', 'getSurveyCompanyItemInventory')->name('get.survey.company.item.inventory');
        });
    });

    Route::controller(ProcurementController::class)->group(function () {
        Route::prefix('cmt-procurement')->group(function () {
            // halaman utama
            Route::get('/', 'index')->name('com.procurement.index');
            Route::get('/get/table', 'getTableProcurement')->name('com.procurement.getTable');

            // halaman create
            Route::get('/create', 'create')->name('com.procurement.create');
            Route::post('/item/status', 'getStatusItem')->name('com.procurement.getStatusItem');
            Route::get('/table/item/boq', 'getTableItemFromBOQ')->name('com.procurement.getTableItemFromBOQ');
            Route::post('/store', 'storeProcurement')->name('com.procurement.storeProcurement');
            Route::post('/get/detail/item/boq', 'getDetailItem')->name('com.procurement.getDetailItem');

            // halaman detail
            Route::get('/detail/{id}', 'detailProcurement')->name('com.procurement.detail');
            Route::get('/table/item/procurement', 'getTableItemProcurement')->name('com.procurement.getTableItemProcurement');
            Route::post('/update/item/procurement/{id}', 'updateItemProcurement')->name('com.procurement.updateItemProcurement');

            // halaman detail item procurement
            Route::get('/detail/item/{id}', 'detailItemProcurement')->name('com.procurement.detail.item');
        });
    });

    Route::controller(QuotationController::class)->group(function () {
        Route::prefix('cmt-quotation')->group(function () {
            Route::get('/', 'index')->name('com.quotation.index'); // quotation internet
            Route::get('/quotation-perangkat', 'perangkat')->name('com.quotation.perangkat.index'); // quotation perangkat

            Route::get('/get-data/table/data-result', 'getDatatable')->name('com.quotation.render.datatable');

            Route::get('/quotation-result-export/{isQuotation}/{id}', 'exportQuotationResult')->name('com.quotation.result.export');

            Route::get('/create-quotation', 'createQuotation')->name('com.quotation.create.quotation');
            Route::get('/update-quotation', 'updateQuotation')->name('com.quotation.update.quotation');
            Route::get('/review-done-quotation', 'reviewDoneQuotation')->name('com.quotation.review.done.quotation');

            Route::post('/store-po-quotation', 'storePurchaseOrder')->name('com.quotation.store.po');
            Route::post('/store-data-quotation', 'saveAndStoreQuotation')->name('com.quotation.store.quotation');

            Route::post('/cancel-quotation', 'cancelQuotation')->name('com.quotation.cancel.quotation');

            Route::get('/get-internet-bundling', 'getInternetBundling')->name('com.quotation.get.internet.bundling');
            Route::post('/update-internet-bundling', 'updateInternetBundling')->name('com.quotation.update.internet.bundling');
        });
    });
});

require __DIR__ . '/auth.php';
