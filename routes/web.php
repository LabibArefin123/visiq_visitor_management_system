<?php

use App\Http\Controllers\AiController;
use App\Http\Controllers\Employee_Attendance;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Notification_And_Alert;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Reporting_And_Analytics;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Roles_And_Permissions;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\System_Setting;
use App\Http\Controllers\User_Management;
use App\Http\Controllers\Visitor_Attendance;
use App\Http\Controllers\VisitorCompanyController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\VisitorHostController;
use App\Http\Controllers\PendingVisitorController;
use App\Http\Controllers\VisitorBlacklistController;
use App\Http\Controllers\VisitorEmergencyController;
use App\Http\Controllers\VisitorGroupMemberController;
use App\Http\Controllers\VisitorGroupScheduleController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware(['auth', 'check_permission'])->group(function () {

    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/user_profile', [ProfileController::class, 'user_profile_show'])->name('profile');
    Route::get('/user_profile/edit', [ProfileController::class, 'user_profile_edit'])->name('profile.edit');
    Route::put('/user_profile/update', [ProfileController::class, 'user_profile_update'])->name('profile.update');

    Route::get('/ai_chat', [AiController::class, 'ai_chat_index'])->name('ai_chat.index');
    Route::post('/ai-chat', [AiController::class, 'ai_chat_response'])->name('ai.chat.response');
    Route::post('/ai-chat-store', [AiController::class, 'storeChat'])->name('ai.chat.store');
    Route::get('/ai-chat-list', [AiController::class, 'listChats'])->name('ai.chat.list');
    Route::get('/ai-chat-view/{id}', [AiController::class, 'viewChat'])->name('ai.chat.view');
    Route::get('/ai-chat-pdf', [AiController::class, 'ai_chat_pdf'])->name('ai.chat.pdf');
    Route::get('/ai-chat/download/{id}', [AiController::class, 'downloadAIChatPDF'])->name('ai.chat.download');

    Route::resource('organizations', OrganizationController::class);
    Route::resource('pending_visitors', PendingVisitorController::class);
    Route::resource('visitor_blacklists', VisitorBlacklistController::class);
    Route::resource('visitor_emergencys', VisitorEmergencyController::class);

    Route::get('/visitor/qr-code/pdf/{id}', [VisitorController::class, 'generateQRCodePDF'])->name('visitor.qr_code.pdf');
    Route::get('/visitor/checkin/{id}', [VisitorController::class, 'checkIn'])->name('visitor.checkin');
    Route::get('/visitor/send-qr/whatsapp/{id}', [VisitorController::class, 'sendQRCodeToWhatsApp'])->name('send.qr.whatsapp');
    Route::get('/visitor/send-qr/email/{id}', [VisitorController::class, 'sendQRCodeToEmail'])->name('send.qr.email');

    Route::get('/check_in_visitors', [Visitor_Attendance::class, 'check_in_visitor'])->name('check_in_visitor');
    Route::get('check_out_visitors', [Visitor_Attendance::class, 'check_out_visitor'])->name('visitor_check_out');

    Route::resource('visitor_host_schedules', VisitorHostController::class);
    Route::resource('visitor_group_schedules', VisitorGroupScheduleController::class);

    Route::resource('visitor_companys', VisitorCompanyController::class);
    Route::get('/visitor_company/pdf/{id}', [VisitorCompanyController::class, 'downloadPDF'])->name('visitor_company.pdf');
    Route::get('/visitor_company/word/{id}', [VisitorCompanyController::class, 'downloadWord'])->name('visitor_company.word');
    Route::resource('visitor_group_members', VisitorGroupMemberController::class);

    Route::resource('employees', EmployeeController::class);

    Route::get('/check_in_employee', [Employee_Attendance::class, 'checkin'])->name('check_in_employee');
    Route::get('/check_out_employee', [Employee_Attendance::class, 'checkout'])->name('check_out_employee');
    Route::get('/check_in_employee_manual', [Employee_Attendance::class, 'checkin_manual'])->name('check_in_employee_manual');
    Route::get('/check_out_employee_manual', [Employee_Attendance::class, 'checkout_manual'])->name('check_out_employee_manual');
    Route::post('/check_in_employee_store', [Employee_Attendance::class, 'checkin_employee_store'])->name('checkin_employee_store');
    Route::post('/check_out_employee_store', [Employee_Attendance::class, 'checkout_employee_store'])->name('checkout_employee_store');

    Route::get('/visitor_report', [Reporting_And_Analytics::class, 'visitor_attendance_report'])->name('reporting.analytics.visitorReport');
    Route::get('/generate-visitor-report', [Reporting_And_Analytics::class, 'generateVisitorAttendanceReport'])->name('reporting.analytics.generateVisitorReport');
    Route::post('/visitor_report/pdf', [Reporting_And_Analytics::class, 'pdf_for_visitor'])->name('reporting.analytics.pdfVisitorReport');
    Route::post('/visitor_report_with_host', [Reporting_And_Analytics::class, 'generateVisitorReportHost'])->name('reporting.analytics.generateVisitorReportHost');
    Route::get('/visitor-report/download', [Reporting_And_Analytics::class, 'downloadVisitorReport'])->name('reporting.analytics.downloadVisitorReport');
    Route::get('/employee_attendance_report', [Reporting_And_Analytics::class, 'employee_attendance_report'])->name('employee_attendance_report');
    Route::post('/employee-attendance-report/generate', [Reporting_And_Analytics::class, 'generateAttendanceReport'])->name('employee_attendance_report.generate');
    Route::post('/employee-attendance-report/download', [Reporting_And_Analytics::class, 'downloadAttendanceReport'])->name('employee_attendance_report.download');

    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('system_users', UserController::class);
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
});

Auth::routes();
