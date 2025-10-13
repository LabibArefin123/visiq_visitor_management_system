<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::orderBy('created_at','DESC')->paginate(10);
        return view('roles_and_permission.permission_list',[
            'permissions' => $permissions
        ]);
    }
    public function create()
    {
        return view('roles_and_permission.permission_create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:permissions|min:3'
        ]);

        if($validator->passes()){
            Permission::create(['name' => $request->name]);
            return redirect()->route('permission.index')->with('success','Permission created successfully.');

        }else{
            return redirect()->route('permission.create')->withInput()->withErrors($validator);
        }
    }
    public function edit($id)
    {
        $permission = Permission::findById($id);
        return view('roles_and_permission.permission_edit',[
            'permission' => $permission
        ]);
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::findById($id);
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:permissions,name,'.$id.',id|min:3'
        ]);
        if($validator->passes()){
            
            $permission->name = $request->name;
            $permission->save();
            return redirect()->route('permission.index')->with('success','Permission updated successfully.');
        }else{
            return redirect()->route('permission.edit',$id)->withInput()->withErrors($validator);
        }
    }

    public function destroy($id)
    {
        $permission = Permission::findById($id);
        $permission->delete();
        return redirect()->route('permission.index')->with('success','Permission deleted successfully.');
    }

    
}
