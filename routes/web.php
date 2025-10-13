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
use App\Http\Controllers\Visitor_Company;
use App\Http\Controllers\Visitor_Management;
use App\Http\Controllers\Visitor_Schedule;
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

    Route::get('/guest_card', [Visitor_Management::class, 'generateGuestCard'])->name('guest_card');
    Route::get('/visitor_log', [Visitor_Management::class, 'visitor_home'])->name('visitor_management');
    Route::get('/visitor/view/{id}', [Visitor_Management::class, 'visitor_view'])->name('visitor.view');
    Route::get('/visitor_log/delete/{id}', [Visitor_Management::class, 'destroy'])->name('visitor.delete');
    Route::get('/visitor_log_edit/{id}', [Visitor_Management::class, 'visitor_log_edit'])->name('visitor_log_edit');
    Route::put('/visitor_log_edit/{id}', [Visitor_Management::class, 'visitor_log_update'])->name('visitor.update');
    Route::get('/visitor_blank_pdf', [Visitor_Management::class, 'downloadBlankPDF'])->name('visitor_blank_pdf');
    Route::get('/visitor_blank_word', [Visitor_Management::class, 'downloadBlankWord'])->name('visitor_blank_word');
    Route::get('/visitor/print/{id}', [Visitor_Management::class, 'printVisitor'])->name('visitor.print');
    Route::get('/visitor_log/{id}/generateQR', [Visitor_Management::class, 'generate_visitor_QR'])->name('visitor.generateQR');

    Route::get('/pending_visitor_log', [Visitor_Management::class, 'pending_visitor_home'])->name('pending_visitor_management');
    Route::get('/pending_visitor_log/create', [Visitor_Management::class, 'pending_visitor_create'])->name('pending_visitor.create');
    Route::post('/pending_visitor_log', [Visitor_Management::class, 'pending_visitor_store'])->name('pending_visitor.store');
    Route::get('/pending_visitor_log/approve/{id}', [Visitor_Management::class, 'approve'])->name('pending_visitor.approve');
    Route::get('/pending_visitor_log/delete/{id}', [Visitor_Management::class, 'pending_visitor_delete'])->name('pending_visitor.delete');
    Route::get('/pending_visitor_log/edit/{id}', [Visitor_Management::class, 'pending_visitor_edit'])->name('pending_visitor.edit');
    Route::put('/pending_visitor_log/update/{id}', [Visitor_Management::class, 'pending_visitor_update'])->name('pending_visitor.update');

    Route::get('/visitor_blacklist', [Visitor_Management::class, 'indexBlacklist'])->name('visitor_blacklist');
    Route::get('/visitor_blacklist/add', [Visitor_Management::class, 'createBlacklist'])->name('visitor_blacklist.create');
    Route::post('/visitor_blacklist/store', [Visitor_Management::class, 'storeBlacklist'])->name('visitor_blacklist.store');
    Route::get('/visitor_blacklist/edit/{id}', [Visitor_Management::class, 'editBlacklist'])->name('visitor_blacklist.edit');
    Route::put('/visitor_blacklist/update/{id}', [Visitor_Management::class, 'updateBlacklist'])->name('visitor_blacklist.update');
    Route::get('/visitor_blacklist/delete/{id}', [Visitor_Management::class, 'destroyBlacklist'])->name('visitor_blacklist.delete');

    Route::get('/visitor_emergency', [Visitor_Management::class, 'indexEmergency'])->name('visitor_emergency.index');
    Route::get('/visitor_emergency/create', [Visitor_Management::class, 'createEmergency'])->name('visitor_emergency.create');
    Route::post('/visitor_emergency/store', [Visitor_Management::class, 'storeEmergency'])->name('visitor_emergency.store');
    Route::get('/visitor_emergency/edit/{id}', [Visitor_Management::class, 'editEmergency'])->name('visitor_emergency.edit');
    Route::put('/visitor_emergency/update/{id}', [Visitor_Management::class, 'updateEmergency'])->name('visitor_emergency.update');
    Route::delete('/visitor_emergency/delete/{id}', [Visitor_Management::class, 'destroyEmergency'])->name('visitor_emergency.delete');

    Route::post('/generate-temp-qr', [Visitor_Management::class, 'generateTempQRCode'])->name('generate_temp_qr');
    Route::post('/scan-qr', [Visitor_Management::class, 'scanQRCode'])->name('scan_qr');
    Route::get('/visitor-qr-submit/{token}', [Visitor_Management::class, 'processQRCode'])->name('visitor_qr_submit');

    Route::get('/visitor-qr', [Visitor_Management::class, 'visitorQRIndex'])->name('visitor.qr');
    Route::get('/visitor/qr-code/pdf/{id}', [Visitor_Management::class, 'generateQRCodePDF'])->name('visitor.qr_code.pdf');
    Route::get('/visitor/checkin/{id}', [Visitor_Management::class, 'checkIn'])->name('visitor.checkin');
    Route::get('/visitor/send-qr/whatsapp/{id}', [Visitor_Management::class, 'sendQRCodeToWhatsApp'])->name('send.qr.whatsapp');
    Route::get('/visitor/send-qr/email/{id}', [Visitor_Management::class, 'sendQRCodeToEmail'])->name('send.qr.email');

    Route::get('/check_in_visitor', [Visitor_Attendance::class, 'check_in_visitor'])->name('check_in_visitor');
    Route::get('/check_out_visitor', [Visitor_Attendance::class, 'check_out_visitor'])->name('visitor_check_out');
    Route::get('/checkin_visitor_manual', [Visitor_Attendance::class, 'checkin_visitor_manual'])->name('checkin_visitor_manual');
    Route::post('/checkin_visitor_manual', [Visitor_Attendance::class, 'store_checkin_manual'])->name('store_checkin_manual');
    Route::get('/checkout_visitor_manual', [Visitor_Attendance::class, 'checkout_visitor_manual'])->name('checkout_visitor_manual');
    Route::post('/checkout_visitor_manual', [Visitor_Attendance::class, 'store_checkout_manual'])->name('store_checkout_manual');

    Route::get('/visitor_host_schedule', [Visitor_Schedule::class, 'visitor_host_schedule_index'])->name('visitor_schedule.index');
    Route::get('/visitor_host_schedule/create', [Visitor_Schedule::class, 'visitor_host_schedule_create'])->name('visitor_schedule.create');
    Route::post('/visitor_host_schedule/store', [Visitor_Schedule::class, 'visitor_host_schedule_store'])->name('visitor_schedule.store');
    Route::get('/visitor_host_schedule/{id}/view', [Visitor_Schedule::class, 'visitor_host_schedule_view'])->name('visitor_schedule.view');
    Route::get('/visitor_host_schedule/{id}/edit', [Visitor_Schedule::class, 'visitor_host_schedule_edit'])->name('visitor_schedule.edit');
    Route::put('/visitor_host_schedule/{id}/update', [Visitor_Schedule::class, 'visitor_host_schedule_update'])->name('visitor_schedule.update');
    Route::delete('/visitor_host_schedule/{id}/delete', [Visitor_Schedule::class, 'visitor_host_schedule_destroy'])->name('visitor_schedule.delete');
    Route::get('/visitor-group-schedule', [Visitor_Schedule::class, 'visitor_group_schedule_index'])->name('visitor_schedule.group.index');
    Route::get('/visitor-group-schedule/create', [Visitor_Schedule::class, 'visitor_group_schedule_create'])->name('visitor_schedule.group.create');
    Route::post('/visitor-group-schedule/store', [Visitor_Schedule::class, 'visitor_group_schedule_store'])->name('visitor_schedule.group.store');
    Route::get('/visitor-group-schedule/edit/{id}', [Visitor_Schedule::class, 'visitor_group_schedule_edit'])->name('visitor_schedule.group.edit');
    Route::post('/visitor-group-schedule/update/{id}', [Visitor_Schedule::class, 'visitor_group_schedule_update'])->name('visitor_schedule.group.update');
    Route::delete('/visitor-group-schedule/delete/{id}', [Visitor_Schedule::class, 'visitor_group_schedule_delete'])->name('visitor_schedule.group.delete');

    Route::get('/visitor_company', [Visitor_Company::class, 'visitor_company'])->name('visitor_company');
    Route::get('/visitor-company/create', [Visitor_Company::class, 'visitor_company_create'])->name('visitor_company.create');
    Route::post('/visitor-company/store', [Visitor_Company::class, 'visitor_company_store'])->name('visitor_company.store');
    Route::get('/visitor_company/edit/{id}', [Visitor_Company::class, 'visitor_company_edit'])->name('visitor_company.edit');
    Route::put('/visitor_company/edit/{id}', [Visitor_Company::class, 'visitor_company_update'])->name('visitor_company.update');
    Route::get('/visitor_company/view/{id}', [Visitor_Company::class, 'visitor_company_view'])->name('visitor_company.view');
    Route::get('/visitor_company/pdf/{id}', [Visitor_Company::class, 'downloadPDF'])->name('visitor_company.pdf');
    Route::get('/visitor_company/word/{id}', [Visitor_Company::class, 'downloadWord'])->name('visitor_company.word');
    Route::get('/visitor_group_members/{visitorId}', [Visitor_Company::class, 'indexGroupMembers'])->name('visitor_group_member.index');
    Route::get('/visitor_group_members/view/{memberId}', [Visitor_Company::class, 'viewGroupMember'])->name('visitor_group_member.view');
    Route::get('/visitor_group_members/add/{visitorId}', [Visitor_Company::class, 'addGroupMember'])->name('visitor_group_member.add');
    Route::post('/visitor_group_members/store/{visitorId}', [Visitor_Company::class, 'storeGroupMember'])->name('visitor_group_member.store');
    Route::get('/visitor_group_members/edit/{memberId}', [Visitor_Company::class, 'editGroupMember'])->name('visitor_group_member.edit');
    Route::put('/visitor_group_members/update/{memberId}', [Visitor_Company::class, 'updateGroupMember'])->name('visitor_group_member.update');
    Route::get('/visitor_group_members/delete/{memberId}', [Visitor_Company::class, 'deleteGroupMember'])->name('visitor_group_member.delete');

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

    Route::post('/employee/checkin', [Employee_Management::class, 'checkInEmployee'])->name('employee.checkin');
    Route::get('/attendance_tracking', [Employee_Management::class, 'attendance_tracking'])->name('attendance_tracking');
    Route::get('/attendance/check-in/{id}', [Employee_Management::class, 'check_in'])->name('attendance.checkin');
    Route::get('/attendance/check-out/{id}', [Employee_Management::class, 'check_out'])->name('attendance.checkout');

    Route::get('/employee_notifications', [Employee_Management::class, 'employee_notifications'])->name('employee.notifications');
    Route::post('/employee/notify/{id}', [Employee_Management::class, 'notify_employee'])->name('employee.notify');
    Route::get('/roles_and_permission', [Employee_Management::class, 'role_index'])->name('roles.index'); // Show roles and permissions
    Route::post('/roles_and_permission/store-role', [Employee_Management::class, 'storeRole'])->name('roles.store'); // Create a new role
    Route::post('/roles_and_permission/remove-role', [Employee_Management::class, 'removeRole'])->name('roles.remove'); // Remove a role // Create a new permission
    Route::post('/roles_and_permission/remove-permission', [Employee_Management::class, 'removePermission'])->name('permissions.removePermission'); // Remove a permission// Show assign roles and permissions page
    Route::post('/roles_and_permission/assign-role', [Employee_Management::class, 'assignRole'])->name('roles.permissions.assignRole'); // Assign role to employee
    Route::post('/roles_and_permission/assign-permission', [Employee_Management::class, 'assignPermission'])->name('roles.permissions.assignPermission'); // Assign permissions to role

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

    Route::get('/visitor_alerts', [Notification_And_Alert::class, 'visitor_alert_index'])->name('visitor_alerts.index');
    Route::get('/visitor_alerts/create', [Notification_And_Alert::class, 'visitor_alert_create'])->name('visitor_alerts.create');
    Route::post('/visitor_alerts/create', [Notification_And_Alert::class, 'visitor_alert_store'])->name('visitor_alerts.store');
    Route::delete('/visitor_alerts/{id}', [Notification_And_Alert::class, 'visitor_alert_destroy'])->name('visitor_alerts.destroy');
    Route::get('/visitor_alerts/notify/{id}', [Notification_And_Alert::class, 'showNotifyForm'])->name('visitor_alerts.notify.form');
    Route::post('/visitor_alerts/notify/send', [Notification_And_Alert::class, 'sendVisitorAlert'])->name('visitor_alerts.notify.send');
    Route::get('/overdue_checkout_alert', [Notification_And_Alert::class, 'overdue_checkout_alert'])->name('overdue_checkout_alert');
    Route::get('/overdue-alerts', [Notification_And_Alert::class, 'overdueAlerts'])->name('overdue.alerts');
    Route::post('/notify-overdue/{id}', [Notification_And_Alert::class, 'notifyOverdue'])->name('notifications.notifyOverdue');
    Route::get('/system_notification', [Notification_And_Alert::class, 'system_notification'])->name('system_notification');
    Route::get('/system_notification/create', [Notification_And_Alert::class, 'createSystemNotification'])->name('notificationsAndAlerts.createSystemNotification');
    Route::post('/system_notification/store', [Notification_And_Alert::class, 'storeSystemNotification'])->name('notificationsAndAlerts.storeSystemNotification');
    Route::delete('/system_notification/{id}', [Notification_And_Alert::class, 'deleteSystemNotification'])->name('notificationsAndAlerts.deleteSystemNotification');

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

    Route::get('/all-permissions', [Roles_And_Permissions::class, 'permissionsIndex'])->name('permissions.index');
    Route::post('/permissions/store', [Roles_And_Permissions::class, 'storeEmployeePermission'])->name('permissions.storePermission');
    Route::get('/all-modules', [Roles_And_Permissions::class, 'modulesIndex'])->name('modules.index');
    Route::get('/modules', [Roles_And_Permissions::class, 'allModules'])->name('modules.all');
    Route::get('/modules/create', [Roles_And_Permissions::class, 'createModule'])->name('modules.create');
    Route::post('/modules', [Roles_And_Permissions::class, 'storeModule'])->name('modules.store');
    Route::get('/modules/show/{id}', [Roles_And_Permissions::class, 'showModule'])->name('modules.show');
    Route::post('/modules/assign', [Roles_And_Permissions::class, 'assignModules'])->name('modules.assign');
    Route::get('/module/edit/{id}', [Roles_And_Permissions::class, 'editModules'])->name('modules.edit');
    Route::put('/module/update/{id}', [Roles_And_Permissions::class, 'updateModules'])->name('modules.update');
    Route::delete('/modules/delete/{id}', [Roles_And_Permissions::class, 'deleteModule'])->name('modules.delete');
    Route::get('/permissions/show-code/{id}', [Roles_And_Permissions::class, 'showCode'])->name('permissions.showCode');

    Route::get('/permissions', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::post('/permissions/{id}', [PermissionController::class, 'update'])->name('permission.update');
    Route::delete('/permissions/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy');

    Route::get('/roles', [RoleController::class, 'index'])->name('role.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('role.store');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('/roles/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('role.destroy');

    Route::get('/roles_list', [RoleController::class, 'role_list'])->name('role_permission.index');
    Route::get('/roles_list/create', [RoleController::class, 'role_list_create'])->name('role_permission.create');
    Route::post('/roles_list', [RoleController::class, 'role_list_store'])->name('role_permission.store');
    Route::get('/roles_list/{id}/edit', [RoleController::class, 'role_list_edit'])->name('role_permission.edit');
    Route::post('/roles_list/{id}/update', [RoleController::class, 'role_list_update'])->name('role_permission.update');
    Route::delete('/roles_list/{id}', [RoleController::class, 'role_list_delete'])->name('role_permission.delete');


    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
});

Auth::routes();

