<?php

namespace App\Http\Controllers\backend\theme\clasic\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Designation;
use App\model\Module;
use App\model\UserRoll;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index user
    // ********************************************** user start ********************************************
    function indexUser()
    {
        $users = User::latest()->with('designation')
                ->where('status',1)
                ->orderBy('id', 'desc')
                ->paginate('10');
        if (Auth::user()->type == 'Admin') {
            return view('backend.theme.clasic.user.user_list', compact('users'));
        } else {
            return view('backend.theme.clasic.user.user_list_employee', compact('users'));
        }
        
    }
    //create user
    function createUser()
    {
        $designations = Designation::where("status", 1)
                        ->orderBy("designation_name", 'desc')
                        ->get();
        return view('backend.theme.clasic.user.create_user', compact('designations'));
    }

    //store user
    function storeUser(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'type' => ['required',  'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nid_number' => 'required',
            'employee_type' => 'required',
            'excess_type' => 'required',
            'designation_id' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Please Enter User Name!',
            'type.required' => 'Please Enter User Type',
            'email.required' => 'Please Enter User Email',
            'nid_number.required' => 'Please Enter User NID',
            'employee_type.required' => 'Please Enter Employee Type',
            'excess_type' => 'Please Enter User Excess ',
            'designation_id.required' => 'Please Enter Designation Type',
            'password.required' => 'Please Enter User Password',
        ]);
        $photo = null;
        if ($request->photo != '') {
            $image = $request->file('photo');
            $name_gen = $image->getClientOriginalName();
            Image::make($image)->resize(580, 600)->save('public/uploads/profile/' . $name_gen);
            $photo = 'public/uploads/profile/' . $name_gen;
        }
        User::insert([
            'name' => $request->name,
            'type' => $request->type,
            'email' => $request->email,
            'nid_number' => $request->nid_number,
            'photo' => $photo,
            'employee_type' => $request->employee_type,
            'designation_id' => $request->designation_id,
            'excess_type' => $request->excess_type,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);


        $notification = ([
            'success' => 'User Created Successfully',
        ]);
        return redirect()->route('user-list')->with($notification);
    }
    //edit user
    function editUser($user_id)
    {
        $user = User::findOrFail($user_id);
        $designations = Designation::where("status", 1)
                        ->orderBy("designation_name", 'desc')
                        ->get();
        return view('backend.theme.clasic.user.edit_user', compact('user','designations'));
    }
    //user update

    function updateUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => ['required',  'max:255'],
            'nid_number' => 'required',
            'employee_type' => 'required',
            'designation_id' => 'required',
            'excess_type' => 'required',
        ], [
            'name.required' => 'Please Enter User Name!',
            'type.required' => 'Please Enter User Type',
            'nid_number.required' => 'Please Enter User NID',
            'employee_type.required' => 'Please Enter Employee Type',
            'designation_id.required' => 'Please Enter Designation ',
            'excess_type.required' => 'Please Enter User Excess ',
        ]);


        $user_id = $request->id;
        $reqEmail = $request->email;
        $validEmail = User::Where("email", $reqEmail)->where('id', '!=', $user_id)->first();
        $photo = User::findOrFail($user_id)->photo;
        if ($request->photo != '') {
            $old_photo = $request->old_photo;
            File::delete($old_photo);
            $image = $request->file('photo');
            $name_gen = $image->getClientOriginalName();
            Image::make($image)->resize(580, 600)->save('public/uploads/profile/' . $name_gen);
            $photo = 'public/uploads/profile/' . $name_gen;
        }
        if ($validEmail == null) {
            User::findOrFail($user_id)->update([
                'name' => $request->name,
                'type' => $request->type,
                'email' => $request->email,
                'nid_number' => $request->nid_number,
                'employee_type' => $request->employee_type,
                'excess_type' => $request->excess_type,
                'designation_id' => $request->designation_id,
                'photo' => $photo,
                'updated_at' => Carbon::now(),
            ]);
        } else {

            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ], [
                'email.required' => 'Please Enter Unique Email',
            ]);

            User::findOrFail($user_id)->update([
                'name' => $request->name,
                'type' => $request->type,
                'email' => $request->email,
                'nid_number' => $request->nid_number,
                'employee_type' => $request->employee_type,
                'designation_id' => $request->designation_id,
                'photo' => $photo,
                'updated_at' => Carbon::now(),
            ]);
        }




        $notification = ([
            'success' => 'User Updated Successfully',
        ]);
        return redirect('/user-list')->with($notification);
    }

    //delete user

    function deleteUser($user_id)
    {
        $user =  User::findOrFail($user_id);
        $user->status = 0;
        $user->save();
        return redirect()->back();
    }

    // change user password

    function changeUserPassword(Request $request){

        $request->validate([
            'old_password' => 'required',
            'password' => 'required',
        ], [
            'old_password.required' => 'Please Enter the Old Password',
            'password.required' => 'Please Enter the New Password',
        ]);
        $userPass = User::findOrFail($request->id);
        if (Hash::check($request->old_password ,$userPass->password)) {
            $userPass->update(['password'=> Hash::make($request->password)]);
            $notification = ([
                'success' => 'Password Changed Successfully',
            ]);
            return redirect()->back()->with($notification);
        } else{
            $notification = [
                'error' => 'Password Didn\'t Matched !',
            ];
            return redirect()->back()->with($notification);
        }
    }

    // user designation 
    function designation(){
        $designations = Designation::where("status", 1)->orderBy("designation_name", 'asc')->paginate();
        return view('backend.theme.clasic.user.designation',compact('designations'));
    }

    //add designation

    function addUpdateDesignation(Request $request){

        $request->validate([
            'designation_name' => 'required',
        ], [
            'designation_name.required' => 'Please Enter Designation Name',
        ]);
        if ($request->id) {
            Designation::findOrFail($request->id)->update([
                'designation_name' => $request->designation_name,
            ]);

            $notification = ([
                'success' => 'Designation Updated Successfully',
            ]);
            return redirect()->back()->with($notification);
        } else{
            Designation::create([
                'designation_name' => $request->designation_name,
            ]);

            $notification = ([
                'success' => 'Designation Saved Successfully',
            ]);
            return redirect()->back()->with($notification);
        }
    }

    //delete designation 
    function deleteDesignation($designation_id){
        Designation::findOrFail($designation_id)->update(['status'=> 0]);
        return redirect()->back();
    }
    // ********************************************** user end ********************************************
    // ********************************************** user profile start ********************************************

    function indexProfile(){
        return view('backend.theme.clasic.user.profile.user_info');
    }

    // user upload image
    function uploadImage(){

        $userinfo = User::where('id', Auth::id())->first();
        return view('backend.theme.clasic.user.profile.upload_photo', compact('userinfo'));
    }

    // upload profile photo of user
    function storeUserPhoto(Request $request){
        $request->validate([
            'photo' => 'required',
        ], [
            'photo.required' => 'Opps! Please Choose a Photo.',
        ]);
        $userinfo = User::where('id', Auth::id())->first();
        $photo = $userinfo->photo; // user photo
        if ($request->photo != '') {
            $old_photo = $request->old_photo;
            File::delete($old_photo);
            $image = $request->file('photo');
            $name_gen = $image->getClientOriginalName();
            Image::make($image)->resize(580, 600)->save('public/uploads/profile/' . $name_gen);
            $photo = 'public/uploads/profile/' . $name_gen;
        }

        User::findOrFail(Auth::id())->update([
            'photo' => $photo,
        ]);


        $notification = ([
            'success' => 'Your Photo Successfully',
        ]);
        return redirect()->route('profile')->with($notification);
    }

    //change password
    function changePassword(){

        return view('backend.theme.clasic.user.profile.change_password');
    }

    // change password store
    function changePasswordStore(Request $request){
        $request->validate([
            'old_password' => 'required',
            'password' => 'required',
        ], [
            'old_password.required' => 'Please Enter the Old Password',
            'password.required' => 'Please Enter the New Password',
        ]);
        $userPass = User::findOrFail(Auth::id());
        if (Hash::check($request->old_password ,$userPass->password)) {
            $userPass->update(['password'=> Hash::make($request->password)]);
            
            $notification = ([
                'success' => 'Password Changed! Please Login Again!',
            ]);
            Auth::logout();
            return redirect('/login')->with($notification);
        } else{

            $notification = [
                'error' => 'Password Didn\'t Matched !',
            ];
            return redirect()->back()->with($notification);
        }

    }

    // edit user profile
    function editYourProfile(){
        return view('backend.theme.clasic.user.profile.edit_profile');
    }

    // update user profile

    function updateYourProfile(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'nid_number' => 'required',
        ], [
            'name.required' => 'Please Enter Your Name',
            'email.required' => 'Please Enter Your Email',
            'nid_number.required' => 'Please Enter Your NID Number',
        ]);

        User::findOrFail(Auth::id())->update([
            'name' => $request->name,
            'email' => $request->email,
            'nid_number' => $request->nid_number,
        ]);
        $notification = ([
            'success' => 'Your Information Updated Successfully',
        ]);
        return redirect()->route('profile')->with($notification);
    }

    // ********************************************** user profile end ********************************************
    
    
    
    // ********************************************** user excess start ********************************************
   
    function user_excess($user_id){
        $user = User::findOrFail($user_id);
        if (Auth::user()->type == 'Admin') {
            $modules = Module::orderBy('id', "ASC")
                    ->where('orgine', 0)
                    ->where('parents', 0)
                    ->get();
            $user_roll = UserRoll::with('user')
                    ->with('module')->where('user_id', $user_id)
                    ->where('is_deleted', 0)
                    ->where('status', 1)
                    ->latest()
                    ->paginate(10);
            return view('backend.theme.clasic.user.user_excess', compact('user_roll','user','modules'));
        } else {
            $notification = ([
                'error' => 'Sorry You Have No Permission for Excess This One!',
            ]);
            return redirect()->back()->with($notification);
        }
     
    }
    

    function user_excess_store(Request $request){
        // dd($request->all());
        foreach($request->module_id as $module_id){
            $userExit =  UserRoll::where('user_id',$request->id)->where('module_id',$module_id)->first();
            if (isset($userExit->module_id)) {
                UserRoll::findOrFail($userExit->id)->update([
                    'user_id' => $request->id,
                    'module_id' => $module_id,
                    'updated_at' => Carbon::now()
                ]);
            } else {
                UserRoll::create([
                    'user_id' => $request->id,
                    'module_id' => $module_id,
                    'created_at' => Carbon::now()
                ]);
            }


        }
        return redirect()->back()->with('success', 'User Excess Stored Successfully.');
    }

    // function user_excess_page($user_id){

    //     $modules = Module::orderBy('title', "ASC")->get();
    //     $user = User::findOrFail($user_id);
    //     $user_roll = UserRoll::with('user')->with('module')->where('user_id', $user_id)->where('is_deleted', 0)->where('status', 1)->get();
    //     // dd($user_roll);
    //     return view('backend.admin_panel.user.user_excess_page', compact('user_roll', 'user','modules'));
    // }

    function delete_user_excess($excess_id){
        UserRoll::findOrFail($excess_id)->delete();
         return redirect()->back()->with('danger', 'Delete Successfully.');

    }

    //delete all user excess
    function deleteAllUserExcess($user_id){
       $userRolls =  UserRoll::where(['user_id'=> $user_id,'status'=>1])->get();
    
       foreach ($userRolls as $roll) {
          UserRoll::findOrFail($roll->id)->delete();
       }
       
       return redirect()->back()->with('danger', 'Deleted All Successfully.');

    }

    // ********************************************** user excess end ********************************************

}
