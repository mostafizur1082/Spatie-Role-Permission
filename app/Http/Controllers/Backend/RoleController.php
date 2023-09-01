<?php

namespace App\Http\Controllers\Backend;

use App\Exports\PermissionExport;
use App\Http\Controllers\Controller;
use App\Imports\PermissionImport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DB;

class RoleController extends Controller
{
    public function AllPermission(){
        $permissions = Permission::all();
        return view('backend.pages.permission.all_permission', compact('permissions'));
    }

    public function AddPermission(){
        return view('backend.pages.permission.add_permisiion');
    }

    public function StorePermission(Request $request){
         Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission insert successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);
    }

    public function EditPermission($id){
        $permission = Permission::findOrFail($id);
        return view('backend.pages.permission.edit_permission', compact('permission'));
    }

    public function UpdatePermission(Request $request, $id){

        Permission::findOrFail($id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permisiion Update successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);

    }

    public function DeletePermission($id){
        Permission::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Permission Delete successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function ImportPermission(){
        return view('backend.pages.permission.import_permission');
    }

    public function Export(){

        return Excel::download(new PermissionExport, 'permission.xlsx');
    }

    public function Import(Request $request){

        Excel::import(new PermissionImport, $request->file('import_file'));
        
        $notification = array(
            'message' => 'Permission Imported successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function AllRole(){
        $roles = Role::all();
        return view('backend.pages.role.all_role', compact('roles'));
    }

    public function AddRole(){
        return view('backend.pages.role.add_role');
    }

    public function StoreRole(Request $request){
        $role = Role::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role insert successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.role')->with($notification);
    }

    public function EditRole($id){
        Role::findOrFail($id);
        return view('backend.pages.role.edit_role', compact('role'));
    }

    public function UpdateRole(Request $request, $id){

        Role::findOrFail($id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role Update successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.role')->with($notification);

    }

    public function DeleteRole($id){
        Role::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Role Delete successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function AddRolePermission(){
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
         return view('backend.pages.rolesetup.add_role_permission', compact('roles','permissions','permission_groups'));
    }

    public function RolePermissionStore(Request $request){

        $data = array();
        $permissions = $request->permission;

        foreach($permissions as $key => $item){
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        }

         $notification = array(
            'message' => 'Role Permission Added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.role.permission')->with($notification);

    }

    public function AllRolePermission(){
        $roles = Role::all();
         return view('backend.pages.rolesetup.all_role_permission', compact('roles'));
    }

    public function EditRolePermission($id){
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
        return view('backend.pages.rolesetup.edit_role_permission', compact('role','permissions','permission_groups'));
    }

    public function UpdateRolePermission(Request $request, $id){

        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }
        $notification = array(
            'message' => 'Role Permission Updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.role.permission')->with($notification);
    }

    public function DeleteRolePermission($id){

        $role = Role::findOrFail($id);

        if(!is_null($role)){
            $role->delete();
        }

        $notification = array(
            'message' => 'Role Permission Delete successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

}
