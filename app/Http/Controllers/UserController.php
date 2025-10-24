<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all(); // Paginate with 10 items per page
        return view('pages.setting_management.system_user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('pages.setting_management.system_user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name'      => 'required|string|max:50',
            'username'  => 'required|string|max:255|unique:users,username',
            'email'     => 'required|email|unique:users,email',
            'phone'     => 'required|string|max:15',
            'password'  => 'required|string|min:8|confirmed',
            'role'      => 'required|string|exists:roles,name',
        ]);

        // User Create
        $user = User::create([
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'password'  => Hash::make($request->password),
        ]);

        // Assign Role
        $role = Role::where('name', $request->role)->first();
        if ($role) {
            $user->assignRole($role->name);
        }

        return redirect()
            ->route('system_users.index')
            ->with('success', 'User added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('pages.setting_management.system_user.view', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('pages.setting_management.system_user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validation
        $request->validate([
            'name'      => 'required|string|max:50',
            'username'  => 'required|string|max:255|unique:users,username,' . $user->id,
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'phone'     => 'required|string|max:15',
            'role'      => 'required|string|exists:roles,name',
            'current_password'      => 'nullable|required_with:password|string',
            'password'              => 'nullable|string|min:8|confirmed',
        ]);

        // যদি password পরিবর্তন করতে চায়, তবে current password check হবে
        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors([
                    'current_password' => 'বর্তমান পাসওয়ার্ড সঠিক নয়।',
                ]);
            }
            $user->password = Hash::make($request->password);
        }

        // User data update
        $user->name     = $request->name;
        $user->username = $request->username;
        $user->email    = $request->email;
        $user->phone    = $request->phone;
        $user->save();

        // Role update
        $role = Role::where('name', $request->role)->first();
        if ($role) {
            $user->syncRoles([$role->name]);
        }

        return redirect()->route('system_users.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('system_users.index')->with('success', 'User deleted successfully!');
    }
}
