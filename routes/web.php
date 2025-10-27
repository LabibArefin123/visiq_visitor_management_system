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

    Route::resource('visitor_host_schedules', VisitorHostController::class);
    Route::resource('visitor_group_schedules', VisitorGroupScheduleController::class);

    Route::resource('visitor_companys', VisitorCompanyController::class);
    Route::get('/visitor_company/pdf/{id}', [VisitorCompanyController::class, 'downloadPDF'])->name('visitor_company.pdf');
    Route::get('/visitor_company/word/{id}', [VisitorCompanyController::class, 'downloadWord'])->name('visitor_company.word');
    Route::resource('visitor_group_members', VisitorGroupMemberController::class);

    Route::resource('employees', EmployeeController::class);

    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('system_users', UserController::class);
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
});

Auth::routes();
