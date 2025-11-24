<?php

use App\Http\Controllers\AiController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeAttendanceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SearchController;

//building menu
use App\Http\Controllers\AreaController;
use App\Http\Controllers\SubAreaController;
use App\Http\Controllers\BuildingLocationController;
use App\Http\Controllers\BuildingListController;
use App\Http\Controllers\RoomListController;

//organization menu
use App\Http\Controllers\OrganizationController;

//branch menu
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\DepartmentController;

//visitor menu
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\PendingVisitorController;
use App\Http\Controllers\VisitorCompanyController;
use App\Http\Controllers\VisitorHostScheduleController;
use App\Http\Controllers\VisitorEmergencyController;
use App\Http\Controllers\VisitorGroupMemberController;
use App\Http\Controllers\VisitorProbationController;
use App\Http\Controllers\VisitorBlacklistController;

//recruitment menu
use App\Http\Controllers\VisitorJobApplicationController;

//schedule menu
use App\Http\Controllers\OfficeScheduleController;
use App\Http\Controllers\ShiftScheduleController;
use App\Http\Controllers\InterviewScheduleController;
use App\Http\Controllers\MeetingScheduleController;
use App\Http\Controllers\WeekendScheduleController;
use App\Http\Controllers\VisitorGroupScheduleController;
use App\Http\Controllers\ShiftGuardScheduleController;

//report menu
use App\Http\Controllers\VisitorReportController;
use App\Http\Controllers\VisitorCompanyReportController;
use App\Http\Controllers\EmployeeReportController;

//security menu
use App\Http\Controllers\AccessPointController;
use App\Http\Controllers\GuardController;
use App\Http\Controllers\VisitorIdCardController;
use App\Http\Controllers\IdCardController;
use App\Http\Controllers\AccessPointGuardController;
use App\Http\Controllers\AccessHistoryLogController;
use App\Http\Controllers\GuardActivityLogController;
use App\Http\Controllers\MedicalEmergencyController;
use App\Http\Controllers\OverstayAlertController;
use App\Http\Controllers\EvacuationPlanController;
use App\Http\Controllers\EmergencyIncidentController;
use App\Http\Controllers\BlacklistMonitorController;

//parking menu
use App\Http\Controllers\ParkingLocationController;
use App\Http\Controllers\ParkingListController;
use App\Http\Controllers\ParkingPermitController;
use App\Http\Controllers\ParkingAllotmentController;

//facility menu
use App\Http\Controllers\SeatAllocationController;

//asset menu
use App\Http\Controllers\LostAndFoundController;

//communication menu
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\VisitorFeedbackController;

//setting menu
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserCategoryController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware(['auth', 'check_permission'])->group(function () {

    //top menu and profile
    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/user_profile', [ProfileController::class, 'user_profile_show'])->name('profile');
    Route::get('/user_profile/edit', [ProfileController::class, 'user_profile_edit'])->name('profile.edit');
    Route::put('/user_profile/update', [ProfileController::class, 'user_profile_update'])->name('profile.update');
    Route::get('/notifications/search', [SearchController::class, 'search'])->name('notifications.search');

    Route::get('/ai_chat', [AiController::class, 'ai_chat_index'])->name('ai_chat.index');
    Route::post('/ai-chat', [AiController::class, 'ai_chat_response'])->name('ai.chat.response');
    Route::post('/ai-chat-store', [AiController::class, 'storeChat'])->name('ai.chat.store');
    Route::get('/ai-chat-list', [AiController::class, 'listChats'])->name('ai.chat.list');
    Route::get('/ai-chat-view/{id}', [AiController::class, 'viewChat'])->name('ai.chat.view');
    Route::get('/ai-chat-pdf', [AiController::class, 'ai_chat_pdf'])->name('ai.chat.pdf');
    Route::get('/ai-chat/download/{id}', [AiController::class, 'downloadAIChatPDF'])->name('ai.chat.download');

    //ajax controller
    Route::get('/get-locations-by-area', [AjaxController::class, 'getLocationsByArea'])->name('ajax.getLocationsByArea');
    Route::get('/get-buildings-by-location', [AjaxController::class, 'getBuildingsByLocation'])->name('ajax.getBuildingsByLocation');
    Route::get('/get-parking-location-by-buidling-name', [AjaxController::class, 'getParkingLocationByBuildingName'])->name('ajax.getParkingLocationByBuildingName');
    Route::get('/get-parking-by-parking-location', [AjaxController::class, 'getParkingByParkingLocationName'])->name('ajax.getParkingByParkingLocationName');
    Route::get('/get-division-by-branch', [AjaxController::class, 'getDivisionByBranch'])->name('ajax.getDivisionByBranch');
    Route::get('/get-department-by-division', [AjaxController::class, 'getDepartmentByDivision'])->name('ajax.getDepartmentByDivision');
    Route::get('/get-holders/{type}', [AjaxController::class, 'getHolders'])->name('ajax.getHolders');
    Route::get('/get-holders-by-visitor/{type}', [AjaxController::class, 'getHoldersByVisitor'])->name('ajax.getHoldersByVisitor');
    Route::get('/get-reporters/{type}', [AjaxController::class, 'getReporters'])->name('ajax.getReporters');

    //organization menu
    Route::resource('organizations', OrganizationController::class);

    //department menu
    Route::resource('branches', BranchController::class);
    Route::resource('divisions', DivisionController::class);
    Route::resource('departments', DepartmentController::class);

    //building menu
    Route::resource('areas', AreaController::class);
    Route::resource('sub_areas', SubAreaController::class);
    Route::resource('building_locations', BuildingLocationController::class);
    Route::resource('building_lists', BuildingListController::class);
    Route::resource('room_lists', RoomListController::class);

    //visitor menu
    Route::resource('visitor_job_applications', VisitorJobApplicationController::class);

    //visitor menu
    Route::resource('visitors', VisitorController::class);
    Route::resource('pending_visitors', PendingVisitorController::class);
    Route::post('/pending-visitors/{id}/approve', [PendingVisitorController::class, 'approve'])->name('pending_visitors.approve');
    Route::resource('visitor_emergencys', VisitorEmergencyController::class);
    Route::resource('visitor_group_members', VisitorGroupMemberController::class);
    Route::resource('visitor_companies', VisitorCompanyController::class);
    Route::get('/visitor_company/pdf/{id}', [VisitorCompanyController::class, 'downloadPDF'])->name('visitor_company.pdf');
    Route::get('/visitor_company/word/{id}', [VisitorCompanyController::class, 'downloadWord'])->name('visitor_company.word');
    Route::resource('visitor_probations', VisitorProbationController::class);
    Route::resource('visitor_blacklists', VisitorBlacklistController::class);
    Route::get('/visitor_blacklist_monitor', [BlacklistMonitorController::class, 'index'])->name('visitor_blacklists.activity_log');

    //employee menu
    Route::resource('employees', EmployeeController::class);
    Route::get('employee_attendances', [EmployeeAttendanceController::class, 'index'])->name('employee_attendances.index');
    Route::get('/check-in-employees', [EmployeeAttendanceController::class, 'checkInEmployees'])->name('employees.check_in_employee.index');
    Route::get('/check-out-employees', [EmployeeAttendanceController::class, 'checkOutEmployees'])->name('employees.check_out_employee.index');

    //parking menu
    Route::resource('parking_locations', ParkingLocationController::class);
    Route::resource('parking_lists', ParkingListController::class);
    Route::resource('parking_permits', ParkingPermitController::class);
    Route::resource('parking_allotments', ParkingAllotmentController::class);

    //schedule menu
    Route::resource('office_schedules', OfficeScheduleController::class);
    Route::resource('shift_schedules', ShiftScheduleController::class);
    Route::get('meeting_schedules', [MeetingScheduleController::class, 'index'])->name('meeting_schedules.index');
    Route::resource('interview_schedules', InterviewScheduleController::class);
    Route::resource('shift_guard_schedules', ShiftGuardScheduleController::class);
    Route::resource('visitor_host_schedules', VisitorHostScheduleController::class);
    Route::resource('visitor_group_schedules', VisitorGroupScheduleController::class);
    Route::resource('weekend_schedules', WeekendScheduleController::class);

    //report menu
    Route::get('report/visitor/daily/', [VisitorReportController::class, 'dailyIndex'])->name('report.visitor.daily');
    Route::get('report/visitor/daily/pdf', [VisitorReportController::class, 'dailyDownloadPdf'])->name('report.visitor.daily.pdf');
    Route::get('report/visitor/monthly/', [VisitorReportController::class, 'monthlyIndex'])->name('report.visitor.monthly');
    Route::get('report/visitor/monthly/pdf', [VisitorReportController::class, 'monthlyDownloadPdf'])->name('report.visitor.monthly.pdf');
    Route::get('report/visitor/yearly/', [VisitorReportController::class, 'yearlyIndex'])->name('report.visitor.yearly');
    Route::get('report/visitor/yearly/pdf', [VisitorReportController::class, 'yearlyDownloadPdf'])->name('report.visitor.yearly.pdf');
    Route::get('report/company_visitor/daily/', [VisitorCompanyReportController::class, 'dailyIndex'])->name('report.visitor.company.daily');
    Route::get('report/company_visitor/daily/pdf', [VisitorCompanyReportController::class, 'dailyDownloadPdf'])->name('report.visitor.company.daily.pdf');
    Route::get('report/company_visitor/monthly/', [VisitorCompanyReportController::class, 'monthlyIndex'])->name('report.visitor.company.monthly');
    Route::get('report/company_visitor/monthly/pdf', [VisitorCompanyReportController::class, 'monthlyDownloadPdf'])->name('report.visitor.company.monthly.pdf');
    Route::get('report/company_visitor/yearly/', [VisitorCompanyReportController::class, 'yearlyIndex'])->name('report.visitor.company.yearly');
    Route::get('report/company_visitor/yearly/pdf', [VisitorCompanyReportController::class, 'yearlyDownloadPdf'])->name('report.visitor.company.yearly.pdf');
    Route::get('report/employee/daily/', [EmployeeReportController::class, 'dailyIndex'])->name('report.employee.daily');
    Route::get('report/employee/daily/pdf', [EmployeeReportController::class, 'dailyDownloadPdf'])->name('report.employee.daily.pdf');
    Route::get('report/employee/monthly/', [EmployeeReportController::class, 'monthlyIndex'])->name('report.employee.monthly');
    Route::get('report/employee/monthly/pdf', [EmployeeReportController::class, 'monthlyDownloadPdf'])->name('report.employee.monthly.pdf');
    Route::get('report/employee/yearly/', [EmployeeReportController::class, 'yearlyIndex'])->name('report.employee.yearly');
    Route::get('report/employee/yearly/pdf', [EmployeeReportController::class, 'yearlyDownloadPdf'])->name('report.employee.yearly.pdf');

    //security menu
    Route::resource('guards', GuardController::class);
    Route::resource('id_cards', IdCardController::class);
    Route::resource('visitor_id_cards', VisitorIdCardController::class);
    Route::put('visitor-id-cards/{id}/approve', [VisitorIdCardController::class, 'approve'])->name('visitor_id_cards.approve');
    Route::get('/visitor-id-card/pdf/{id}', [VisitorIdCardController::class, 'pdfStream'])->name('visitor_id_cards.pdf');
    Route::get('/visitor-id-cards/{id}/print', [VisitorIdCardController::class, 'print'])->name('visitor_id_cards.print');
    Route::get('guard_activity_log', [GuardActivityLogController::class, 'index'])->name('guards.activity_log');
    Route::resource('access_points', AccessPointController::class);
    Route::resource('access_point_guards', AccessPointGuardController::class);
    Route::get('access_point_guard_history_log', [AccessHistoryLogController::class, 'index'])->name('access_point_guards.activity_log');
    Route::resource('overstay_alerts', OverstayAlertController::class);
    Route::resource('medical_emergencies', MedicalEmergencyController::class);
    Route::resource('evacuation_plans', EvacuationPlanController::class);
    Route::resource('emergency_incidents', EmergencyIncidentController::class);

    //facility menu
    Route::resource('seat_allocations', SeatAllocationController::class);
    //asset menu
    Route::resource('lost_and_founds', LostAndFoundController::class);

    //communication menu
    Route::resource('announcements', AnnouncementController::class);
    Route::get('/visitor_feedback', [VisitorFeedbackController::class, 'index'])->name('visitors.feedback');

    //setting menu
    Route::resource('user_categories', UserCategoryController::class);
    Route::resource('roles', RoleController::class);
    Route::post('/permissions/delete-selected', [PermissionController::class, 'deleteSelected'])->name('permissions.deleteSelected');
    Route::resource('permissions', PermissionController::class);
    Route::resource('system_users', UserController::class);
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
});

Auth::routes();
