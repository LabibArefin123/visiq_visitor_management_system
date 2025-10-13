<?php

namespace App\Http\Controllers;

use App\Models\BlacklistedVisitor;
use App\Models\ChatAIData;
use App\Models\CheckInEmployee;
use App\Models\CheckOutEmployee;
use App\Models\EmergencyVisitor;
use App\Models\Employee;
use App\Models\EmployeeReport;
use App\Models\OpenAIModel;
use App\Models\Role;
use App\Models\Visitor;
use App\Models\VisitorCheckin;
use App\Models\VisitorCheckout;
use App\Models\VisitorCompany;
use App\Models\VisitorGroupHostSchedule;
use App\Models\VisitorReport;
use App\Models\VisitorSchedule;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AiController extends Controller
{
    public function ai_chat_index()
    {
        return view('ai_chat');
    }

    public function ai_chat_response(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = strtolower($request->input('message'));

        try {
            // Friendly responses
            $greetings = [
                "hello" => "Hello! How can I assist you today?",
                "hi" => "Hi there! Need any help?",
                "hey" => "Hey! How's your day going?",
                "how are you" => "I'm just a virtual assistant, but I'm here to help! How can I assist you?",
                "what's up" => "Not much! Just here to assist you with visitor and employee management.",
                "good morning" => "Good morning! Hope you have a great day ahead!",
                "good afternoon" => "Good afternoon! What can I do for you?",
                "good evening" => "Good evening! Let me know if you need any help.",
                "thank you" => "You're welcome! Let me know if you need anything else.",
                "thanks" => "No problem! Always happy to help.",
                "bye" => "Goodbye! Have a great day!",
            ];

            foreach ($greetings as $key => $response) {
                if (str_contains($message, $key)) {
                    return response()->json([
                        'success' => true,
                        'response' => $response,
                    ]);
                }
            }

            // Check for "blacklist visitor"


            if (strtolower($message) === 'all employees') {
                $employees = Employee::all();

                if ($employees->isEmpty()) {
                    return response()->json(['success' => true, 'response' => 'No employees found.']);
                }

                $response = "👨‍💼 All Employees:\n\n";

                foreach ($employees as $emp) {
                    $response .= "----------------------------------------\n";
                    $response .= "🔸 EID           : {$emp->e_id}\n";
                    $response .= "🔸 Name          : {$emp->name}\n";
                    $response .= "🔸 Phone         : {$emp->phone}\n";
                    $response .= "🔸 Email         : {$emp->email}\n";
                    $response .= "🔸 Department    : {$emp->department}\n";
                    $response .= "🔸 Date of Birth : {$emp->dob}\n";
                }

                return response()->json(['success' => true, 'response' => nl2br($response)]);
            }


            // ✅ All visitors
            if (strtolower($message) === 'all visitors') {
                $visitors = Visitor::all();

                if ($visitors->isEmpty()) {
                    return response()->json(['success' => true, 'response' => 'No visitors found.']);
                }

                $response = "👥 All Visitors:\n\n";

                foreach ($visitors as $visitor) {
                    $response .= "----------------------------------------\n";
                    $response .= "🔹 VID           : {$visitor->v_id}\n";
                    $response .= "🔹 Name          : {$visitor->name}\n";
                    $response .= "🔹 Phone         : {$visitor->phone}\n";
                    $response .= "🔹 Email         : {$visitor->email}\n";
                    $response .= "🔹 Date of Birth : {$visitor->date_of_birth}\n";
                }

                return response()->json(['success' => true, 'response' => nl2br($response)]);
            }


            // ✅ All check-in data (employee + visitor)
            if (strtolower($message) === 'check in data') {
                $empIns = CheckInEmployee::with('employee')->latest()->take(5)->get();
                $visIns = VisitorCheckin::with('visitor')->latest()->take(5)->get();

                $response = "📥 Recent Check-Ins:\n";

                if ($empIns->isEmpty() && $visIns->isEmpty()) {
                    $response .= "No check-in data found.";
                } else {
                    foreach ($empIns as $check) {
                        $response .= "👨‍💼 {$check->employee->name} (Employee) - {$check->check_in_time}, Total: {$check->total_checkins}\n";
                    }
                    foreach ($visIns as $check) {
                        $response .= "👤 {$check->visitor->name} (Visitor) - {$check->check_in_time}, Total: {$check->total_checkins}\n";
                    }
                }

                return response()->json(['success' => true, 'response' => nl2br($response)]);
            }

            // ✅ All check-out data (employee + visitor)
            if (strtolower($message) === 'check out data') {
                $empOuts = CheckOutEmployee::with('employee')->latest()->take(5)->get();
                $visOuts = VisitorCheckout::with('visitor')->latest()->take(5)->get();

                $response = "📤 Recent Check-Outs:\n";

                if ($empOuts->isEmpty() && $visOuts->isEmpty()) {
                    $response .= "No check-out data found.";
                } else {
                    foreach ($empOuts as $out) {
                        $response .= "👨‍💼 {$out->employee->name} (Employee) - {$out->check_out_time}, Total: {$out->total_checkouts}\n";
                    }
                    foreach ($visOuts as $out) {
                        $response .= "👤 {$out->visitor->name} (Visitor) - {$out->check_out_time}, Total: {$out->total_checkouts}\n";
                    }
                }

                return response()->json(['success' => true, 'response' => nl2br($response)]);
            }

            // ✅ Check-in by type
            if (str_contains(strtolower($message), 'check in')) {
                $isEmployee = str_contains(strtolower($message), 'employee');
                $checkInModel = $isEmployee ? CheckInEmployee::class : VisitorCheckin::class;
                $relation = $isEmployee ? 'employee' : 'visitor';

                $checkIns = $checkInModel::with($relation)->latest()->take(5)->get();
                if ($checkIns->isEmpty()) {
                    $response = "No recent check-ins found for " . ($isEmployee ? 'employees' : 'visitors') . ".";
                } else {
                    $response = "📥 Recent " . ucfirst($relation) . " Check-Ins:\n";
                    foreach ($checkIns as $checkIn) {
                        $response .= "{$checkIn->$relation->name} checked in at {$checkIn->check_in_time}, Total: {$checkIn->total_checkins}\n";
                    }
                }

                return response()->json(['success' => true, 'response' => nl2br($response)]);
            }

            // ✅ Check-out by type
            if (str_contains(strtolower($message), 'check out')) {
                $isEmployee = str_contains(strtolower($message), 'employee');
                $checkOutModel = $isEmployee ? CheckOutEmployee::class : VisitorCheckout::class;
                $relation = $isEmployee ? 'employee' : 'visitor';

                $checkOuts = $checkOutModel::with($relation)->latest()->take(5)->get();
                if ($checkOuts->isEmpty()) {
                    $response = "No recent check-outs found for " . ($isEmployee ? 'employees' : 'visitors') . ".";
                } else {
                    $response = "📤 Recent " . ucfirst($relation) . " Check-Outs:\n";
                    foreach ($checkOuts as $checkOut) {
                        $response .= "{$checkOut->$relation->name} checked out at {$checkOut->check_out_time}, Total: {$checkOut->total_checkouts}\n";
                    }
                }

                return response()->json(['success' => true, 'response' => nl2br($response)]);
            }

            // ✅ Ask which type to search
            if (in_array(strtolower($message), ['employee', 'visitor'])) {
                $type = ucfirst(strtolower($message));
                return response()->json(['success' => true, 'response' => "🔎 Please enter the $type name you want to search."]);
            }

            // ✅ Search for specific person by name
            $visitor = Visitor::where('name', 'like', "%$message%")->first();
            $employee = Employee::where('name', 'like', "%$message%")->first();

            if ($visitor || $employee) {
                $isVisitor = $visitor !== null;
                $person = $isVisitor ? $visitor : $employee;
                $checkInModel = $isVisitor ? VisitorCheckin::class : CheckInEmployee::class;
                $checkOutModel = $isVisitor ? VisitorCheckout::class : CheckOutEmployee::class;

                $checkIns = $checkInModel::where($isVisitor ? 'visitor_id' : 'employee_id', $person->id)->get();
                $checkOuts = $checkOutModel::where($isVisitor ? 'visitor_id' : 'employee_id', $person->id)->get();

                $response = ($isVisitor ? "👤 Visitor" : "👨‍💼 Employee") . ": {$person->name}\n";

                if ($checkIns->isEmpty()) {
                    $response .= "No check-in records found.\n";
                } else {
                    $response .= "📥 Check-in Records:\n";
                    foreach ($checkIns as $in) {
                        $response .= "- Checked in at {$in->check_in_time}, Total: {$in->total_checkins}\n";
                    }
                }

                if ($checkOuts->isEmpty()) {
                    $response .= "No check-out records found.\n";
                } else {
                    $response .= "📤 Check-out Records:\n";
                    foreach ($checkOuts as $out) {
                        $response .= "- Checked out at {$out->check_out_time}, Total: {$out->total_checkouts}\n";
                    }
                }

                return response()->json(['success' => true, 'response' => nl2br($response)]);
            }

            if (str_contains($message, 'blacklist visitor')) {
                $blacklistVisitors = BlacklistedVisitor::latest()->take(5)->get();
                if ($blacklistVisitors->isEmpty()) {
                    $response = "No blacklisted visitors found.";
                } else {
                    $response = "Blacklisted Visitors:\n";
                    foreach ($blacklistVisitors as $visitor) {
                        $response .= "- The name of visitor is {$visitor->name} as the reason is {$visitor->reason} and black listed at {$visitor->blacklisted_at}\n";
                    }
                }
                return response()->json(['success' => true, 'response' => nl2br($response)]);
            }

            // Check for "emergency visitor"
            if (str_contains($message, 'emergency visitor')) {
                $emergencyVisitors = EmergencyVisitor::latest()->take(5)->get();
                if ($emergencyVisitors->isEmpty()) {
                    $response = "No emergency visitors found.";
                } else {
                    $response = "Emergency Visitors:\n";
                    foreach ($emergencyVisitors as $visitor) {
                        $response .= "- The name of emergency visitor is {$visitor->name}, as for the reason is {$visitor->emergency_reason} and came at {$visitor->emergency_at}\n";
                    }
                }
                return response()->json(['success' => true, 'response' => nl2br($response)]);
            }

            // Handle Visitor Schedule
            if (str_contains($message, 'visitor schedule')) {
                $schedules = VisitorSchedule::latest()->take(5)->get();
                $response = $schedules->isEmpty() ? "No visitor schedules found." : "Visitor Schedules:\n";
                foreach ($schedules as $schedule) {
                    $response .= "- The name of visitor is {$schedule->visitor_name} as the visitor is scheduled to meet with {$schedule->employee_name}, check in time is {$schedule->check_in_time} and check out time is {$schedule->check_out_time}\n";
                }
                return response()->json(['success' => true, 'response' => nl2br($response)]);
            }

            // Handle Visitor Host Schedule
            if (str_contains($message, 'visitor group schedule')) {
                $hostSchedules = VisitorGroupHostSchedule::latest()->take(5)->get();
                $response = $hostSchedules->isEmpty() ? "No visitor group schedules found." : "Visitor Host Schedules:\n";
                foreach ($hostSchedules as $schedule) {
                    $response .= "- The name of group is {$schedule->company_name} as the company scheduled to meet with {$schedule->employee_name}, the check in time is {$schedule->check_in_time} and check out time is {$schedule->check_out_time}\n";
                }
                return response()->json(['success' => true, 'response' => nl2br($response)]);
            }

            // Handle Visitor Company
            if (str_contains($message, 'visitor company')) {
                $companies = VisitorCompany::latest()->take(5)->get();
                $response = $companies->isEmpty() ? "No visitor companies found." : "Visitor Companies:\n";
                foreach ($companies as $company) {
                    $response .= "- The name of visitor is {$company->contact_person} company is {$company->company_name}, and the purpose they came for {$company->purpose}\n";
                }
                return response()->json(['success' => true, 'response' => nl2br($response)]);
            }

            if (str_contains($message, 'visitor report')) {
                $checkIns = VisitorCheckin::with('visitor')->latest()->take(50)->get();
                $checkOuts = VisitorCheckout::with('visitor')->latest()->take(50)->get();

                $visitorReports = Visitor::with(['checkins', 'checkouts'])->get()->filter(function ($visitor) use ($checkIns, $checkOuts) {
                    return $checkIns->where('visitor_id', $visitor->id)->count() > 0 || $checkOuts->where('visitor_id', $visitor->id)->count() > 0;
                })->map(function ($visitor) use ($checkIns, $checkOuts) {
                    $visitorCheckIns = $checkIns->where('visitor_id', $visitor->id);
                    $visitorCheckOuts = $checkOuts->where('visitor_id', $visitor->id);

                    return (object)[
                        'name'            => $visitor->name,
                        'check_in_time'   => optional($visitorCheckIns->sortBy('check_in_time')->first())->check_in_time,
                        'check_out_time'  => optional($visitorCheckOuts->sortByDesc('check_out_time')->first())->check_out_time ?? 'N/A',
                        'total_checkins'  => $visitorCheckIns->count(),
                        'total_checkouts' => $visitorCheckOuts->count(),
                    ];
                });

                $response = $visitorReports->isEmpty() ? "No visitor reports found." : "Recent Visitor Reports:\n";
                foreach ($visitorReports->take(5) as $report) {
                    $response .= "- {$report->name} checked in at {$report->check_in_time}, checked out at {$report->check_out_time}, total check-ins: {$report->total_checkins}, total check-outs: {$report->total_checkouts}\n";
                }

                return response()->json(['success' => true, 'response' => nl2br($response)]);
            }

            // 👨‍💼 Employee Report Chat Handler
            if (str_contains($message, 'employee report')) {
                $checkIns = CheckInEmployee::with('employee')->latest()->take(50)->get();
                $checkOuts = CheckOutEmployee::with('employee')->latest()->take(50)->get();

                $attendanceRecords = Employee::with(['checkIns', 'checkOuts'])
                    ->get()
                    ->map(function ($employee) use ($checkIns, $checkOuts) {
                        $employeeCheckIns = $checkIns->where('employee_id', $employee->id);
                        $employeeCheckOuts = $checkOuts->where('employee_id', $employee->id);

                        return (object)[
                            'name'            => $employee->name,
                            'check_in_time'   => optional($employeeCheckIns->sortBy('check_in_time')->first())->check_in_time,
                            'check_out_time'  => optional($employeeCheckOuts->sortByDesc('check_out_time')->first())->check_out_time ?? 'N/A',
                            'total_checkins'  => $employeeCheckIns->count(),
                            'total_checkouts' => $employeeCheckOuts->count(),
                        ];
                    });

                $response = $attendanceRecords->isEmpty() ? "No employee attendance reports found." : "Recent Employee Reports:\n";
                foreach ($attendanceRecords->take(5) as $report) {
                    $response .= "- {$report->name} checked in at {$report->check_in_time}, checked out at {$report->check_out_time}, total check-ins: {$report->total_checkins}, total check-outs: {$report->total_checkouts}\n";
                }

                return response()->json(['success' => true, 'response' => nl2br($response)]);
            }

            if (str_contains($message, 'all users')) {
                $users = User::latest()->take(10)->get(); // Fetch latest 10 users

                if ($users->isEmpty()) {
                    return response()->json(['success' => true, 'response' => 'No users found.']);
                }

                // Define user type mappings
                $userTypeMap = [
                    1 => 'Admin',
                    2 => 'D Admin',
                    3 => 'DD Admin',
                    4 => 'AD Admin',
                ];

                $response = "👥 All Users (Latest 10):\n\n";

                foreach ($users as $user) {
                    // Calculate Age from DOB
                    $age = $user->date_of_birth ? Carbon::parse($user->date_of_birth)->age : 'N/A';

                    // Get user type name (fallback to "Unknown" if not found)
                    $userType = $userTypeMap[$user->user_type] ?? 'Unknown';

                    $response .= "----------------------------------------\n";
                    $response .= "🔹 NID           : {$user->nid}\n";
                    $response .= "🔹 Name          : {$user->name}\n";
                    $response .= "🔹 Email         : {$user->email}\n";
                    $response .= "🔹 Date of Birth : {$user->date_of_birth}\n";
                    $response .= "🔹 Age           : {$age} years\n";
                    $response .= "🔹 Phone 1       : {$user->phone_1}\n";
                    $response .= "🔹 Phone 2       : {$user->phone_2}\n";
                    $response .= "🔹 User Type     : {$userType}\n";
                }

                return response()->json(['success' => true, 'response' => nl2br($response)]);
            }

            // Start 'add user' conversation
            if (str_contains($message, 'add user')) {
                Session::put('adding_user_step', 'ask_name');
                return response()->json(['success' => true, 'response' => 'Let\'s add a user. What is the name of the user?']);
            }

            // Handle add user flow step by step
            if (Session::get('adding_user_step') === 'ask_name') {
                Session::put('new_user.name', $message);
                Session::put('adding_user_step', 'ask_email');
                return response()->json(['success' => true, 'response' => 'What is the email of the user?']);
            }

            if (Session::get('adding_user_step') === 'ask_email') {
                if (!filter_var($message, FILTER_VALIDATE_EMAIL)) {
                    return response()->json(['success' => false, 'response' => 'Invalid email. Please enter a valid email address.']);
                }

                if (User::where('email', $message)->exists()) {
                    return response()->json(['success' => false, 'response' => 'Email already exists. Try a different one.']);
                }

                Session::put('new_user.email', $message);
                Session::put('adding_user_step', 'ask_phone');
                return response()->json(['success' => true, 'response' => 'What is the phone number? (or type skip)']);
            }

            if (Session::get('adding_user_step') === 'ask_phone') {
                if (strtolower($message) !== 'skip') {
                    Session::put('new_user.phone', $message);
                }
                Session::put('adding_user_step', 'ask_password');
                return response()->json(['success' => true, 'response' => 'Enter a password (min 8 characters):']);
            }

            if (Session::get('adding_user_step') === 'ask_password') {
                if (strlen($message) < 8) {
                    return response()->json(['success' => false, 'response' => 'Password too short. Must be at least 8 characters.']);
                }
                Session::put('new_user.password', $message);
                Session::put('adding_user_step', 'ask_confirm_password');
                return response()->json(['success' => true, 'response' => 'Confirm the password:']);
            }

            if (Session::get('adding_user_step') === 'ask_confirm_password') {
                if ($message !== Session::get('new_user.password')) {
                    return response()->json(['success' => false, 'response' => 'Passwords do not match. Try again.']);
                }
                Session::put('adding_user_step', 'ask_role');
                return response()->json(['success' => true, 'response' => 'What is the role? (admin, dd admin, ad admin, d admin)']);
            }

            if (Session::get('adding_user_step') === 'ask_role') {
                $validRoles = ['admin', 'dd admin', 'ad admin', 'd admin'];
                if (!in_array(strtolower($message), $validRoles)) {
                    return response()->json(['success' => false, 'response' => 'Invalid role. Choose from: admin, dd admin, ad admin, d admin']);
                }

                // All fields are ready → create the user
                $user = User::create([
                    'name' => Session::get('new_user.name'),
                    'email' => Session::get('new_user.email'),
                    'phone' => Session::get('new_user.phone'),
                    'password' => Hash::make(Session::get('new_user.password')),
                ]);

                $role = Role::where('name', $message)->first();
                $user->roles()->attach($role);

                // Clean up temp user data
                Session::forget('new_user');
                Session::put('adding_user_step', 'add_another');

                return response()->json(['success' => true, 'response' => "✅ User added successfully!\n\nDo you want to add another user? (yes/no)"]);
            }

            // Add another?
            if (Session::get('adding_user_step') === 'add_another') {
                if (strtolower($message) === 'yes') {
                    Session::put('adding_user_step', 'ask_name');
                    return response()->json(['success' => true, 'response' => 'Let\'s add another user. What is the name?']);
                } else {
                    Session::forget('adding_user_step');
                    return response()->json(['success' => true, 'response' => '👌 Okay! Let me know what else you want to do.']);
                }
            }

            // Step 1: Trigger edit flow
            if (str_contains($message, 'edit user')) {
                Session::put('editing_user_step', 'ask_email');
                return response()->json(['success' => true, 'response' => 'Please enter the email of the user you want to edit.']);
            }

            // Step 2: Get the user by email
            if (Session::get('editing_user_step') === 'ask_email') {
                $user = User::where('email', $message)->first();

                if (!$user) {
                    return response()->json(['success' => false, 'response' => 'User not found. Try another email.']);
                }

                Session::put('editing_user_id', $user->id);
                Session::put('editing_user_step', 'ask_field');
                return response()->json(['success' => true, 'response' => 'Which field do you want to edit? (e.g., name, phone_1, phone_2, address, age, dob, gender, marital_status, nid, user_type)']);
            }

            // Step 3: Choose which field to update
            if (Session::get('editing_user_step') === 'ask_field') {
                $field = strtolower($message);
                $validFields = [
                    'name',
                    'phone_1',
                    'phone_2',
                    'address',
                    'age',
                    'dob',
                    'gender',
                    'marital_status',
                    'nid',
                    'user_type'
                ];

                if (!in_array($field, $validFields)) {
                    return response()->json(['success' => false, 'response' => 'Invalid field. Try again from: ' . implode(', ', $validFields)]);
                }

                Session::put('edit_field', $field);
                Session::put('editing_user_step', 'ask_field_value');
                return response()->json(['success' => true, 'response' => "Enter the new value for {$field}:"]);
            }

            // Step 4: Update the field with the value
            if (Session::get('editing_user_step') === 'ask_field_value') {
                $userId = Session::get('editing_user_id');
                $user = User::find($userId);
                $field = Session::get('edit_field');

                if (!$user) {
                    Session::forget(['editing_user_id', 'editing_user_step', 'edit_field']);
                    return response()->json(['success' => false, 'response' => 'User no longer exists.']);
                }

                $value = $message;

                // Optional validation per field
                if ($field === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    return response()->json(['success' => false, 'response' => 'Invalid email. Try again.']);
                }

                if ($field === 'age' && !is_numeric($value)) {
                    return response()->json(['success' => false, 'response' => 'Age must be a number.']);
                }

                if ($field === 'dob') {
                    try {
                        $value = Carbon\Carbon::parse($value)->toDateString();
                    } catch (\Exception $e) {
                        return response()->json(['success' => false, 'response' => 'Invalid date format. Use YYYY-MM-DD']);
                    }
                }

                if ($field === 'user_type') {
                    $role = Role::find($value);
                    if (!$role) {
                        return response()->json(['success' => false, 'response' => 'Invalid role ID.']);
                    }
                }

                // Capitalize the name if the field is 'name'
                if ($field === 'name') {
                    $value = ucwords(strtolower($value)); // Capitalize the first letter of each word in the name
                }

                $user->$field = $value;
                $user->save();

                // Clear field and ask for more
                Session::forget('edit_field');
                Session::put('editing_user_step', 'edit_another');

                return response()->json(['success' => true, 'response' => "✅ User updated successfully.\nDo you want to edit another field for this user? (yes/no)"]);
            }

            // Step 5: Loop again or finish
            if (Session::get('editing_user_step') === 'edit_another') {
                if (strtolower($message) === 'yes') {
                    Session::put('editing_user_step', 'ask_field');
                    return response()->json(['success' => true, 'response' => 'Which field do you want to edit next?']);
                } else {
                    Session::forget(['editing_user_step', 'editing_user_id', 'edit_field']);
                    return response()->json(['success' => true, 'response' => '👌 Edit finished. What else can I help with?']);
                }
            }

            if (str_contains($message, 'all roles')) {
                $roles = ['Admin', 'DD Admin', 'AD Admin', 'D Admin']; // You can customize this list based on your roles in the system
                return response()->json(['success' => true, 'response' => 'Here are all the roles: ' . implode(', ', $roles)]);
            }

            if (str_contains($message, 'all user roles')) {
                // Fetch users with their roles using Eloquent
                $users = User::latest()->take(10)->get(); // Fetch latest 10 users

                if ($users->isEmpty()) {
                    return response()->json(['success' => true, 'response' => 'No users found.']);
                }

                // Define user type mappings
                $userTypeMap = [
                    1 => 'Admin',
                    2 => 'D Admin',
                    3 => 'DD Admin',
                    4 => 'AD Admin',
                ];

                $response = "👥 All Users Roles (Latest 10):\n\n";

                foreach ($users as $user) {
            
                    // Get user type name (fallback to "Unknown" if not found)
                    $userType = $userTypeMap[$user->user_type] ?? 'Unknown';

                    $response .= "----------------------------------------\n";
                    $response .= "🔹 NID           : {$user->nid}\n";
                    $response .= "🔹 Name          : {$user->name}\n";
                    $response .= "🔹 Email         : {$user->email}\n";
                    
                    $response .= "🔹 User Type     : {$userType}\n";
                }

                return response()->json(['success' => true, 'response' => nl2br($response)]);
            }



            // If the message is unrelated, use AI response
            $response = OpenAIModel::getAIResponse($message);

            return response()->json([
                'success' => true,
                'response' => nl2br($response),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'AI Service is unavailable. Please try again later.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }


    public function storeChat(Request $request)
    {
        $chatId = Str::uuid(); // Generate unique chat ID
        ChatAIData::create([
            'chat_id' => $chatId,
            'chat_content' => $request->chat_content,
            'chat_date' => Carbon::now(),
        ]);

        return response()->json(['message' => 'Chat saved successfully!', 'chat_id' => $chatId]);
    }

    public function listChats()
    {
        $chats = ChatAIData::orderBy('chat_date', 'desc')->get();
        return view('ai_chat_list', compact('chats'));
    }

    public function viewChat($id)
    {
        // Retrieve chat by ID
        $chat = ChatAIData::findOrFail($id);

        return view('ai_chat_view', compact('chat'));
    }

    public function ai_chat_pdf(Request $request)
    {
        $chatContent = $request->query('chat', 'No chat content available');

        $pdf = Pdf::loadView('ai_chat_pdf', compact('chatContent'));
        return $pdf->download('ai_chat.pdf');
    }

    public function downloadAIChatPDF($id)
    {
        $chat = ChatAIData::findOrFail($id);
        $pdf = Pdf::loadView('ai_chat_pdf', compact('chat'));
        return $pdf->download('ai_chat.pdf');
    }
}
