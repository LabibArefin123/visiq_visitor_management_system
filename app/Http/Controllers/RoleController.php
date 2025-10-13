<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::orderBy('name', 'ASC')->paginate(10);
        return view('roles_and_permission.all_roles', [
            'roles' => $roles
        ]);
    }

    public function create()
    {
        $permissions = Permission::orderBy('name', 'ASC')->paginate(10);
        return view('roles_and_permission.role_create', [
            'permissions' => $permissions
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles|min:3'
        ]);

        if ($validator->passes()) {
            $role = Role::create(['name' => $request->name]);
            if (!empty($request->permission)) {
                foreach ($request->permission as $name) {
                    $role->givePermissionTo($name);
                }
            }

            return redirect()->route('role.index')->with('success', 'Role created successfully.');
        } else {
            return redirect()->route('role.create')->withInput()->withErrors($validator);
        }
    }

    public function edit($id)
    {
        $role = Role::findById($id);
        $hasPermissions = $role->permissions->pluck('name');
        $permissions = Permission::orderBy('name', 'ASC')->paginate(10);
        return view('roles_and_permission.role_edit', [
            'role' => $role,
            'permissions' => $permissions,
            'hasPermissions' => $hasPermissions
        ]);
    }

    public function update(Request $request, $id)
    {
        $role = Role::findById($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $id . ',id'
        ]);
        if ($validator->passes()) {
            $role->name = $request->name;
            $role->save();
            if (!empty($request->permission)) {
                $role->syncPermissions($request->permission);
            } else {
                $role->syncPermissions([]);
            }
            return redirect()->route('role.index')->with('success', 'Role updated successfully.');
        } else {
            return redirect()->route('role.edit', $id)->withInput()->withErrors($validator);
        }
    }

    public function destroy($id)

    {
        $role = Role::findById($id);
        $role->delete();
        return redirect()->route('role.index')->with('success', 'Role deleted successfully.');
    }

    public function role_list()
    {
        $roles = DB::table('roles_permissions')->get();

        $roles->transform(function ($role) {
            $role->routes = json_decode($role->routes, true);
            $role->route_count = is_array($role->routes) ? count($role->routes) : 0;
            return $role;
        });

        return view('roles_and_permission.role_list', compact('roles'));
    }


    public function role_list_create()
    {
        $routes = collect(Route::getRoutes())->filter(function ($route) {
            return $route->getName(); // Only named routes
        });

        // Group routes by section using name prefixes
        $groupedRoutes = [];

        foreach ($routes as $route) {
            $name = $route->getName();

            if (str_starts_with($name, 'visitor')) {
                $groupedRoutes['Visitor Management'][] = $route;
            } elseif (str_starts_with($name, 'employee')) {
                $groupedRoutes['Employee Management'][] = $route;
            } elseif (str_starts_with($name, 'user')) {
                $groupedRoutes['User Management'][] = $route;
            } elseif (str_starts_with($name, 'report')) {
                $groupedRoutes['Reports'][] = $route;
            } elseif (str_starts_with($name, 'role') || str_starts_with($name, 'permission')) {
                $groupedRoutes['Roles & Permissions'][] = $route;
            } else {
                $groupedRoutes['Other'][] = $route;
            }
        }

        return view('roles_and_permission.role_list_create', compact('groupedRoutes'));
    }


    public function role_list_store(Request $request)
    {
        $request->validate([
            'user_type' => 'required|integer',
            'routes'    => 'required|array',
        ]);

        // Store routes assigned to this user_type in roles_permissions table
        DB::table('roles_permissions')->updateOrInsert(
            ['user_type' => $request->user_type],
            ['routes' => json_encode($request->routes)]
        );

        return redirect()->route('role_permission.index')->with('success', 'Permissions assigned successfully!');
    }

    public function role_list_edit($id)
    {
        $role = DB::table('roles_permissions')->where('id', $id)->first();

        if (!$role) {
            return redirect()->route('role_permission.index')->with('error', 'Role not found!');
        }

        $role->routes = json_decode($role->routes ?? '[]', true);

        $routes = collect(Route::getRoutes())->filter(fn($route) => $route->getName());

        $groupedRoutes = [];
        foreach ($routes as $route) {
            $name = $route->getName();
            if (str_starts_with($name, 'visitor')) {
                $groupedRoutes['Visitor Management'][] = $route;
            } elseif (str_starts_with($name, 'employee')) {
                $groupedRoutes['Employee Management'][] = $route;
            } elseif (str_starts_with($name, 'user')) {
                $groupedRoutes['User Management'][] = $route;
            } elseif (str_starts_with($name, 'report')) {
                $groupedRoutes['Reports'][] = $route;
            } elseif (str_starts_with($name, 'role') || str_starts_with($name, 'permission')) {
                $groupedRoutes['Roles & Permissions'][] = $route;
            } else {
                $groupedRoutes['Other'][] = $route;
            }
        }

        return view('roles_and_permission.role_list_edit', compact('groupedRoutes', 'role'));
    }

    public function role_list_update(Request $request, $id)
    {
        $request->validate([
            'user_type' => 'required|integer',
            'routes' => 'required|array',
        ]);

        DB::table('roles_permissions')->where('id', $id)->update([
            'user_type' => $request->user_type,
            'routes' => json_encode($request->routes)
        ]);

        return redirect()->route('role_permission.index')->with('success', 'Permissions updated successfully!');
    }

    public function role_list_delete($id)
    {
        DB::table('roles_permissions')->where('id', $id)->delete();

        return redirect()->route('role_permission.index')->with('success', 'Role deleted successfully!');
    }

}
