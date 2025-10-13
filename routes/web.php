<?php

use App\Http\Controllers\AiController;
use App\Http\Controllers\Employee_Attendance;
use App\Http\Controllers\Employee_Management;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Notification_And_Alert;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Reporting_And_Analytics;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Roles_And_Permissions;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\System_Setting;
use App\Http\Controllers\User_Management;
use App\Http\Controllers\Visitor_Attendance;
use App\Http\Controllers\VisitorCompanyController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\VisitorHostController;
use App\Http\Controllers\VisitorBlacklistController;
use App\Http\Controllers\VisitorEmergencyController;
use App\Http\Controllers\VisitorGroupScheduleController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/statistics', [HomeController::class, 'statistics'])->name('statistics');

    Route::get('/profile-management', [ProfileController::class, 'profileManagement'])->name('profile.management');
    Route::get('/user_profile', [ProfileController::class, 'visitor_profile'])->name('profile');
    Route::get('/user_profile_edit', [ProfileController::class, 'user_profile_edit'])->name('user_profile_edit');
    Route::put('/user_profile_edit', [ProfileController::class, 'user_profile_update'])->name('user_profile_update');
    Route::get('/profile_picture_edit', [ProfileController::class, 'pictureEdit'])->name('profile_picture_edit');
    Route::put('/profile_picture_edit', [ProfileController::class, 'pictureUpdate'])->name('profile_picture_update');
    Route::put('/user_password_update', [ProfileController::class, 'updatePassword'])->name('user_password_update');
    Route::get('/user_password_edit', [ProfileController::class, 'editPassword'])->name('user_password_edit');
    Route::get('/user_password_reset', [ProfileController::class, 'resetPassword'])->name('user_password_reset');

    Route::get('/ai_chat', [AiController::class, 'ai_chat_index'])->name('ai_chat.index');
    Route::post('/ai-chat', [AiController::class, 'ai_chat_response'])->name('ai.chat.response');
    Route::post('/ai-chat-store', [AiController::class, 'storeChat'])->name('ai.chat.store');
    Route::get('/ai-chat-list', [AiController::class, 'listChats'])->name('ai.chat.list');
    Route::get('/ai-chat-view/{id}', [AiController::class, 'viewChat'])->name('ai.chat.view');
    Route::get('/ai-chat-pdf', [AiController::class, 'ai_chat_pdf'])->name('ai.chat.pdf');
    Route::get('/ai-chat/download/{id}', [AiController::class, 'downloadAIChatPDF'])->name('ai.chat.download');

    Route::get('/guest_card', [VisitorController::class, 'generateGuestCard'])->name('guest_card');
    Route::resource('visitors', VisitorController::class);
    Route::get('/visitor_blank_pdf', [VisitorController::class, 'downloadBlankPDF'])->name('visitor_blank_pdf');
    Route::get('/visitor_blank_word', [VisitorController::class, 'downloadBlankWord'])->name('visitor_blank_word');
    Route::get('/visitor/print/{id}', [VisitorController::class, 'printVisitor'])->name('visitor.print');
    Route::get('/visitor_log/{id}/generateQR', [VisitorController::class, 'generate_visitor_QR'])->name('visitor.generateQR');

    Route::resource('visitor_blacklists', VisitorBlacklistController::class);
    Route::resource('visitor_emergencys', VisitorEmergencyController::class);

    Route::post('/generate-temp-qr', [VisitorController::class, 'generateTempQRCode'])->name('generate_temp_qr');
    Route::post('/scan-qr', [VisitorController::class, 'scanQRCode'])->name('scan_qr');
    Route::get('/visitor-qr-submit/{token}', [VisitorController::class, 'processQRCode'])->name('visitor_qr_submit');

    Route::get('/visitor-qr', [VisitorController::class, 'visitorQRIndex'])->name('visitor.qr');
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
    Route::get('/visitor_group_members/{visitorId}', [VisitorCompanyController::class, 'indexGroupMembers'])->name('visitor_group_member.index');
    Route::get('/visitor_group_members/view/{memberId}', [VisitorCompanyController::class, 'viewGroupMember'])->name('visitor_group_member.view');
    Route::get('/visitor_group_members/add/{visitorId}', [VisitorCompanyController::class, 'addGroupMember'])->name('visitor_group_member.add');
    Route::post('/visitor_group_members/store/{visitorId}', [VisitorCompanyController::class, 'storeGroupMember'])->name('visitor_group_member.store');
    Route::get('/visitor_group_members/edit/{memberId}', [VisitorCompanyController::class, 'editGroupMember'])->name('visitor_group_member.edit');
    Route::put('/visitor_group_members/update/{memberId}', [VisitorCompanyController::class, 'updateGroupMember'])->name('visitor_group_member.update');
    Route::get('/visitor_group_members/delete/{memberId}', [VisitorCompanyController::class, 'deleteGroupMember'])->name('visitor_group_member.delete');

    Route::get('/employee_management', [Employee_Management::class, 'employee_management'])->name('employee_management');
    Route::get('/employee/{id}', [Employee_Management::class, 'show'])->name('employee.show');
    Route::get('/employee/{id}/edit', [Employee_Management::class, 'edit'])->name('employee.edit');
    Route::get('/employee_management_create', [Employee_Management::class, 'employee_create'])->name('employee_management_create');
    Route::post('/employee', [Employee_Management::class, 'store'])->name('employee.store');
    Route::put('/employee/{id}', [Employee_Management::class, 'update'])->name('employee.update');
    Route::delete('/employee/{id}', [Employee_Management::class, 'destroy'])->name('employee.destroy');

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

    Route::get('/add_user', [User_Management::class, 'add_user'])->name('add_user');
    Route::get('/users', [User_Management::class, 'user_index'])->name('users.index');
    Route::get('/users/{id}/edit', [User_Management::class, 'user_edit'])->name('users.edit');
    Route::post('/users/{id}', [User_Management::class, 'user_update'])->name('users.update');

    Route::get('/all_users', [User_Management::class, 'allUsers'])->name('all_users');
    Route::get('/user/{id}/view', [User_Management::class, 'allUserView'])->name('all_user_view');
    Route::get('/user/{id}/edit', [User_Management::class, 'allUserEdit'])->name('all_user_edit');
    Route::put('/user/{id}/update', [User_Management::class, 'allUserUpdate'])->name('all_user_update');
    Route::delete('/user/{id}/delete', [User_Management::class, 'allUserDelete'])->name('all_user_delete');
    Route::post('/store_user', [User_Management::class, 'store_user'])->name('store_user');
    Route::get('/user_role', [User_Management::class, 'user_role'])->name('user_role');
    Route::post('/user_role', [User_Management::class, 'store_role'])->name('store_role');
    Route::delete('/user_role/{id}', [User_Management::class, 'delete_role'])->name('delete_role');
    Route::get('/admin/show-routes', [User_Management::class, 'showRoutes'])->name('show_routes');
    Route::get('/admin_user/downloadWord/{id}', [User_Management::class, 'downloadWord'])->name('admin_user.downloadWord');

    Route::get('/general_setting', [System_Setting::class, 'general_setting'])->name('general_setting');
    Route::post('/general_setting/update', [System_Setting::class, 'updateGeneralSetting'])->name('systemSettings.updateGeneralSettings');
    Route::get('/security_setting', [System_Setting::class, 'security_setting'])->name('security_setting');
    Route::get('/user_activity_log', [System_Setting::class, 'userLog'])->name('user_activity_log');
    Route::get('/notification_preferences', [System_Setting::class, 'notification_preferences'])->name('notification_preferences');
    Route::get('/visitor_settings', [System_Setting::class, 'visitor_settings'])->name('visitor_settings');
    Route::post('/visitor_settings/update', [System_Setting::class, 'updateVisitorSettings'])->name('visitor_settings.update');
    Route::get('/employee_access', [System_Setting::class, 'employee_access'])->name('employee_access');
    Route::get('/reports_analytics', [System_Setting::class, 'reports_analytics'])->name('reports_analytics');
    Route::post('/notification_preferences/update', [System_Setting::class, 'updateNotificationPreferences'])->name('notifications.updatePreferences');

    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
});

Auth::routes();
