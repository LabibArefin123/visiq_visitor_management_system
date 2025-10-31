<?php

use App\Http\Controllers\AiController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeAttendanceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\PendingVisitorController;
use App\Http\Controllers\VisitorCompanyController;
use App\Http\Controllers\VisitorHostScheduleController;
use App\Http\Controllers\VisitorBlacklistController;
use App\Http\Controllers\VisitorEmergencyController;
use App\Http\Controllers\VisitorGroupMemberController;
use App\Http\Controllers\GuardController;
use App\Http\Controllers\OfficeScheduleController;
use App\Http\Controllers\ShiftScheduleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
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

    Route::get('/ai_chat', [AiController::class, 'ai_chat_index'])->name('ai_chat.index');
    Route::post('/ai-chat', [AiController::class, 'ai_chat_response'])->name('ai.chat.response');
    Route::post('/ai-chat-store', [AiController::class, 'storeChat'])->name('ai.chat.store');
    Route::get('/ai-chat-list', [AiController::class, 'listChats'])->name('ai.chat.list');
    Route::get('/ai-chat-view/{id}', [AiController::class, 'viewChat'])->name('ai.chat.view');
    Route::get('/ai-chat-pdf', [AiController::class, 'ai_chat_pdf'])->name('ai.chat.pdf');
    Route::get('/ai-chat/download/{id}', [AiController::class, 'downloadAIChatPDF'])->name('ai.chat.download');

    Route::resource('organizations', OrganizationController::class);

    //visitor menu
    Route::resource('visitors', VisitorController::class);
    Route::resource('pending_visitors', PendingVisitorController::class);
    Route::resource('visitor_blacklists', VisitorBlacklistController::class);
    Route::resource('visitor_emergencys', VisitorEmergencyController::class);
    Route::resource('visitor_group_members', VisitorGroupMemberController::class);
    Route::resource('visitor_host_schedules', VisitorHostScheduleController::class);
    Route::resource('visitor_companies', VisitorCompanyController::class);
    Route::get('/visitor_company/pdf/{id}', [VisitorCompanyController::class, 'downloadPDF'])->name('visitor_company.pdf');
    Route::get('/visitor_company/word/{id}', [VisitorCompanyController::class, 'downloadWord'])->name('visitor_company.word');

    //employee menu
    Route::resource('employees', EmployeeController::class);
    Route::resource('employee_attendances', EmployeeAttendanceController::class);
    Route::get('/check-in-employees', [EmployeeAttendanceController::class, 'checkInEmployees'])->name('employees.check_in_employee.index');
    Route::get('/check-out-employees', [EmployeeAttendanceController::class, 'checkOutEmployees'])->name('employees.check_out_employee.index');

    //schedule menu
    Route::resource('office_schedules', OfficeScheduleController::class);
    Route::resource('shift_schedules', ShiftScheduleController::class);

    //security menu
    Route::resource('guards', GuardController::class);

    //setting menu
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('system_users', UserController::class);
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
});

Auth::routes();
