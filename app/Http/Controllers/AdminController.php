<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function AdminDashboard(){
        return view('admin.index');
    }

    public function AdminLogin(){
        return view('admin.admin_login');
    }

    public function AdminLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function AdminProfile(){
        $id = Auth::user()->id;
        $profileData = User::findOrFail($id);
        return view('admin.admin_profile_view',compact('profileData'));
    }

    public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;
        $adminData = User::findOrFail($id);

        $adminData->username = $request->username;
        $adminData->name = $request->name;
        $adminData->email = $request->email;
        $adminData->phone = $request->phone;
        $adminData->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$adminData->photo));
            $name = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$name);
             $adminData['photo'] =  $name;
        }
        $adminData->save();

        $notification = array(
            'message' => 'Admin Profile Update Succesfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function AdminChangePassword(){
        $id = Auth::user()->id;
        $profileData = User::findOrFail($id);
        return view('admin.change_password',compact('profileData'));
    }

    public function adminUpdatePassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        // match the old password

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            $notification = array(
            'message' => 'Old password does not match',
            'alert-type' => 'error'
        );

        return back()->with($notification);
        }else{
            // update password

            User::whereId(auth()->user()->id)->update([
                'password' =>Hash::make($request->new_password)
            ]);

            $notification = array(
            'message' => 'Password change successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification);
        }

    }


    public function AllAdmin(){
        $alladmin = User::where('role','admin')->get();

        return view('backend.pages.admin.all_admin',compact('alladmin'));
    }

    public function AddAdmin(){
        $roles = Role::all();
        return view('backend.pages.admin.add_admin', compact('roles'));
    }

    public function StoreAdmin(Request $request){

        $user = new User();

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';

        $user->save();

        if ($request->role) {
            $user->assignRole($request->role);
        }

        $notification = array(
            'message' => 'Admin Created Succesfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);
    }

    public function EditAdmin($id){
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('backend.pages.admin.edit_admin', compact('user','roles'));
    }

    public function UpdateAdmin(Request $request, $id){

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = 'admin';
        $user->status = 'active';

        $user->save();


        $user->roles()->detach();
        if ($request->role) {
            $user->assignRole($request->role);
        }

        $notification = array(
            'message' => 'Admin Updated Succesfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);
    }

    public function DeleteAdmin($id){

        $user = User::findOrFail($id);

        if(!is_null($user)){
            $user->delete();
        }

        $notification = array(
            'message' => 'Admin Delete successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
