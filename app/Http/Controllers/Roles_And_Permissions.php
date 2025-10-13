<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


class Roles_And_Permissions extends Controller
{
    public function permissionsIndex()
    {
        // Get all routes grouped by controller
        $allRoutes = Route::getRoutes();
        $groupedRoutes = [];
        foreach ($allRoutes as $route) {
            if (isset($route->action['controller']) && isset($route->action['as'])) {
                $controllerName = explode('@', $route->action['controller'])[0];
                $title = $this->getRouteTitle($route->action['as']);
                $groupedRoutes[$controllerName][] = [
                    'name' => $route->action['as'],
                    'title' => $title,
                ];
            }
        }

        // Get existing permissions
        $permissions = Permission::all();

        return view('roles_and_permission.all_permissions_index', compact('groupedRoutes', 'permissions'));
    }

    public function allModules()
    {
        // Get all routes grouped by controller (module)
        $allRoutes = Route::getRoutes();
        $groupedRoutes = [];

        foreach ($allRoutes as $route) {
            // Check if route has controller and name defined
            if (isset($route->action['controller']) && isset($route->action['as'])) {
                // Get the controller name (module) and route name
                $controllerName = explode('@', $route->action['controller'])[0];
                $routeName = $route->action['as'];
                $title = $this->getRouteTitle($routeName); // Assuming getRouteTitle is a helper method you already have

                // Group routes by controller name
                $groupedRoutes[$controllerName][] = [
                    'name' => $routeName,
                    'title' => $title,
                ];
            }
        }

        return view('roles_and_permission.all_module_index', compact('groupedRoutes'));
    }

    public function createModule()
    {
        // Get all routes from web.php
        $allRoutes = Route::getRoutes();
        $controllers = [];

        // Loop through the routes and group them by controller name
        foreach ($allRoutes as $route) {
            if (isset($route->action['controller'])) {
                $controllerName = explode('@', $route->action['controller'])[0];
                $controllers[$controllerName][] = $route->getName();
            }
        }

        // Pass controllers and routes to the view
        return view('roles_and_permission.all_module_create', compact('controllers'));
    }

    // Store the newly created module
    public function storeModule(Request $request)
    {
        // Validate the data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'controller_name' => 'required|string',
            'routes' => 'required|array', // Changed to array for multiple selection
        ]);

        // Store the new module
        $module = new Module();
        $module->name = $request->name;
        $module->description = $request->description;
        $module->controller_name = $request->controller_name;
        $module->routes = json_encode($request->routes); // Store routes as a JSON string
        $module->save();

        return redirect()->route('modules.index')->with('success', 'Module created successfully.');
    }

    public function storeEmployeePermission(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name',
            'module_name' => 'required|string',
        ]);

        Permission::create([
            'name' => $request->name,
            'module_name' => $request->module_name,
        ]);

        return redirect()->route('permissions.index')->with('success', 'Permission added successfully!');
    }

    public function showCode($id)
    {
        $permission = Permission::find($id);

        // Get the route and controller related to this permission
        $code = $this->getFullCodeForPermission($permission);

        return view('roles_and_permission.show_code', compact('permission', 'code'));
    }

    private function getFullCodeForPermission($permission)
    {
        // Define routes, controllers, and Blade files
        $routes = [
            'employee_management' => [
                'route' => "Route::get('/employee_management', [Employee_Management::class, 'employee_management'])->name('employee_management');",
                'controller' => "public function employee_management() {\n    // Employee Management Dashboard logic\n}",
                'blade' => "resources/views/employee_management/index.blade.php"
            ],
            'employee.show' => [
                'route' => "Route::get('/employee/{id}', [Employee_Management::class, 'show'])->name('employee.show');",
                'controller' => "public function show(\$id) {\n    // Show Employee Details logic\n}",
                'blade' => "resources/views/employee_management/show.blade.php"
            ],
            'employee.edit' => [
                'route' => "Route::get('/employee/{id}/edit', [Employee_Management::class, 'edit'])->name('employee.edit');",
                'controller' => "public function edit(\$id) {\n    // Edit Employee logic\n}",
                'blade' => "resources/views/employee_management/edit.blade.php"
            ],
            'employee.store' => [
                'route' => "Route::post('/employee', [Employee_Management::class, 'store'])->name('employee.store');",
                'controller' => "public function store(Request \$request) {\n    // Store Employee logic\n}",
                'blade' => "resources/views/employee_management/create.blade.php"
            ],
            'employee.update' => [
                'route' => "Route::put('/employee/{id}', [Employee_Management::class, 'update'])->name('employee.update');",
                'controller' => "public function update(Request \$request, \$id) {\n    // Update Employee logic\n}",
                'blade' => null // No specific blade file
            ],
            'employee.destroy' => [
                'route' => "Route::delete('/employee/{id}', [Employee_Management::class, 'destroy'])->name('employee.destroy');",
                'controller' => "public function destroy(\$id) {\n    // Delete Employee logic\n}",
                'blade' => null // No specific blade file
            ],
            'check_in_employee' => [
                'route' => "Route::get('/check_in_employee', [Employee_Management::class, 'checkin'])->name('check_in_employee');",
                'controller' => "public function checkin() {\n    // Check-In Employee logic\n}",
                'blade' => "resources/views/employee_management/checkin.blade.php"
            ],
            'check_out_employee' => [
                'route' => "Route::get('/check_out_employee', [Employee_Management::class, 'checkout'])->name('check_out_employee');",
                'controller' => "public function checkout() {\n    // Check-Out Employee logic\n}",
                'blade' => "resources/views/employee_management/checkout.blade.php"
            ],
            'roles.index' => [
                'route' => "Route::get('/roles_and_permission', [Employee_Management::class, 'role_index'])->name('roles.index');",
                'controller' => "public function role_index() {\n    // Display Roles and Permissions\n}",
                'blade' => "resources/views/roles/index.blade.php"
            ],
            'permissions.storePermission' => [
                'route' => "Route::post('/roles_and_permission/store-permission', [Employee_Management::class, 'storePermission'])->name('permissions.storePermission');",
                'controller' => "public function storePermission(Request \$request) {\n    // Store Permission logic\n}",
                'blade' => "resources/views/permissions/create.blade.php"
            ],
            'permissions.removePermission' => [
                'route' => "Route::delete('/permissions/{id}', [Employee_Management::class, 'deletePermission'])->name('permissions.deletePermission');",
                'controller' => "public function deletePermission(\$id) {\n    // Store Permission logic\n}",
                'blade' => null
            ],
            // Add additional routes, controllers, and Blade files here
        ];

        // Return the corresponding code for the selected permission
        return $routes[$permission->name] ?? null;
    }

    private function getRouteTitle($routeName)
    {
        $titles = [
            'employee_management' => 'Employee Management Dashboard',
            'employee.show' => 'View Employee Details',
            'employee.edit' => 'Edit Employee',
            'employee.store' => 'Add New Employee',
            'employee.update' => 'Update Employee Information',
            'employee.destroy' => 'Delete Employee',
            'check_in_employee' => 'Employee Check-In',
            'check_in_employee_try' => 'Employee Check-In (Try)',
            'employee.checkin' => 'Employee Check-In Submission',
            'check_in_employee_manual' => 'Manual Employee Check-In',
            'checkin_employee_store' => 'Store Check-In Information',
            'check_out_employee' => 'Employee Check-Out',
            'check_out_employee_manual' => 'Manual Employee Check-Out',
            'checkout_employee_store' => 'Store Check-Out Information',
            'attendance_tracking' => 'Attendance Tracking',
            'attendance.checkin' => 'Check-In Attendance',
            'attendance.checkout' => 'Check-Out Attendance',
            'employee.notifications' => 'Employee Notifications',
            'employee.notify' => 'Send Notification to Employee',
            'roles.index' => 'Manage Roles and Permissions',
            'roles.store' => 'Create New Role',
            'roles.remove' => 'Remove Role',
            'permissions.storePermission' => 'Create New Permission',
            'permissions.removePermission' => 'Remove Permission',
            'roles.permissions.assignRole' => 'Assign Role to Employee',
            'roles.permissions.assignPermission' => 'Assign Permission to Role',
            'permissions.index' => 'All Permissions',
            'permissions.storePermission' => 'Store Permission',
            'permissions.editPermission' => 'Edit Permission',
            'permissions.updatePermission' => 'Update Permission',
            'permissions.deletePermission' => 'Delete Permission',
            'permissions.showCode' => 'Show Permission Code',
            'permissions.toggleStatus' => 'Toggle Permission Status',
        ];

        // Return the title or default fallback
        return $titles[$routeName] ?? ucfirst(str_replace(['.', '_'], ' ', $routeName));
    }

    public function modulesIndex()
    {
        // Assuming you have a `modules` table or a similar structure in your database
        // You can replace `Module::all()` with your own data retrieval logic
        $modules = Module::all(); // Example: Fetch data from the database
        $users = User::paginate(10); // Example: Fetch users for the view
        // Pass modules data to the view
        return view('roles_and_permission.all_module_index', compact('modules', 'users'));
    }


    public function showModule($id)
    {
        $module = Module::findOrFail($id);
        return view('roles_and_permission.all_module_show', compact('module'));
    }

    public function editModules($id)
    {
        // Retrieve the module data based on the given ID
        $module = Module::findOrFail($id);

        // Pass the module data to the view
        return view('roles_and_permission.all_module_edit', compact('module'));
    }

    public function assignModules(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'modules' => 'array', // Optional: Empty array if no modules are selected
        ]);

        $user = User::find($request->user_id);

        // Sync selected modules (detach unselected ones)
        $user->permissions()->sync($request->modules);

        return redirect()->route('modules.index', ['user' => $user->id])
            ->with('success', 'Modules updated successfully!');
    }

    public function updateModule(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'controller_name' => 'required|string',
            'routes' => 'required|string',
        ]);

        // Find the module by ID
        $module = Module::findOrFail($id);

        // Update the module's properties
        $module->name = $request->name;
        $module->description = $request->description;
        $module->controller_name = $request->controller_name;
        $module->routes = $request->routes; // Process routes if needed (e.g., convert to array)

        // Save the updated module
        $module->save();

        // Redirect with success message
        return redirect()->route('modules.index')->with('success', 'Module updated successfully.');
    }


    public function deleteModule($id)
    {
        // Find the module by ID
        $module = Module::findOrFail($id);

        // Delete the module
        $module->delete();

        // Redirect back with a success message
        return redirect()->route('modules.index')->with('success', 'Module deleted successfully');
    }
}
