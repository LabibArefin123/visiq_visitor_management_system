<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpWord\PhpWord;


class User_Management extends Controller
{

    public function user_index()
    {
        $users = User::latest()->paginate(10);
        return view('user_management.user_list', compact('users'));
    }

    public function user_edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::orderBy('name', 'ASC')->get();
        $hasRoles = $user->roles->pluck('id');
        return view('user_management.user_edit', compact('user', 'roles', 'hasRoles'));
    }
   
    public function user_update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.edit',$id)->withInput()->withErrors($validator);
        }
        $user->name == $request->name;
        $user->email = $request->email;
        $user->save();
        $user->syncRoles($request->role);
        return redirect()->route('users.index')->with('success', 'User updated successfully!');
        
    }

    public function downloadWord($id)
    {
        // Find the admin user by ID
        $admin = User::findOrFail($id);

        // Create a new instance of PhpWord
        $phpWord = new PhpWord();

        // Add a section to the Word document
        $section = $phpWord->addSection();

        // Add user details to the Word document
        $section->addText("Name: " . $admin->name);
        $section->addText("Email: " . $admin->email);
        $section->addText("Roles: " . $admin->roles->pluck('name')->join(', '));

        // Save the Word document as a .docx file
        $fileName = "admin_user_" . $admin->id . ".docx";
        $filePath = storage_path("app/public/{$fileName}");
        $phpWord->save($filePath, 'Word2007');

        // Return the file as a download response
        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function add_user()
    {
        return view('user_management.add_user');
    }

    public function allUsers()
    {
        $users = User::paginate(10); // Paginate with 10 items per page
        return view('user_management.all_user_index', compact('users'));
    }

    public function allUserEdit($id)
    {
        $user = User::findOrFail($id);
        return view('user_profile_edit', compact('user'));
    }

    // Update User
    public function allUserUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:15',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('all_users')->with('success', 'User updated successfully!');
    }

    // View User
    public function allUserView($id)
    {
        $user = User::findOrFail($id);
        return view('user_management.all_user_view', compact('user'));
    }

    // Delete User
    public function allUserDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('all_users')->with('success', 'User deleted successfully!');
    }

    public function showRoutes()
    {
        // Get all routes
        $routes = Route::getRoutes();
        $routeList = [];

        foreach ($routes as $route) {
            // Check if the user has permission to access the route
            $routeList[] = [
                'uri' => $route->uri(),
                'name' => $route->getName(),
                'action' => $route->getActionName(),
                'has_permission' => auth()->user()->hasPermissionTo($route->getActionName()), // Use hasPermissionTo
            ];
        }

        return view('user_management.admin_user_view_roles', compact('routeList'));
    }


    public function user_role()
    {
        $roles = Role::with('permissions')->get();

        // Debug: check roles and permissions
        foreach ($roles as $role) {
            logger()->info("Role: " . $role->name . " | Permissions: " . $role->permissions->pluck('name')->join(', '));
        }
        return view('user_management.user_role', compact('roles'));
    }

    public function store_role(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|unique:roles,name|max:255',
        ]);

        // Create a new role
        Role::create(['name' => $request->name]);

        // Redirect back with success message
        return redirect()->route('user_role')->with('success', 'Role added successfully!');
    }

    public function delete_role($id)
    {
        // Find and delete the role
        $role = Role::findOrFail($id);
        $role->delete();

        // Redirect back with success message
        return redirect()->route('user_role')->with('success', 'Role deleted successfully!');
    }

    public function store_user(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|exists:roles,name', // Ensure the role exists
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Assign the selected role to the user
        $role = Role::where('name', $request->role)->first();
        $user->roles()->attach($role);

        // Redirect with a success message
        return redirect()->route('add_user')->with('success', 'User added successfully!');
    }
}
