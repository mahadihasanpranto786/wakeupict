<?php

namespace App\Http\Controllers\backend\theme\clasic\EmployeeLeave;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\LeaveApplication;
use App\model\LeaveCategory;
use App\model\LeaveTaken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class EmployeeLeaveController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('auth');
    }

    function addLeaveApplication(){
        // $leaves = LeaveCategory::leftJoin('leave_days', 'leave_categories.id', '=', 'leave_days.leave_category_id')
        //     ->leftJoin('leave_takens', 'leave_categories.id', '=', 'leave_takens.leave_category_id')
        //     ->select('leave_categories.*', 'leave_days.leave_days', 'leave_takens.leave_taken')
        //     ->get();
        $leaves = LeaveCategory::orderBy('id', 'desc')->where("status", 1)->get();
        $LeaveApplications = LeaveApplication::orderBy("id", 'desc')->where("status", 1)->paginate(10);
      
        $leaveTaken = LeaveTaken::where("created_by", Auth::id())->get();
        $leaveCategories = LeaveCategory::orderBy("category_name", 'asc')->where("status", 1)->get();
        return view('backend.theme.clasic.employeeLeave.employeeLeaveStore',
        compact(
            'leaveCategories',
            'leaveTaken',
            'leaves',
            'LeaveApplications',
        ));
    }

    // leave category with days
    function leaveCategoryWithDays(){
        $leaveCategories = LeaveCategory::orderBy('id', 'desc')->where('status', 1)->paginate(10);
        return view('backend.theme.clasic.employeeLeave.leaveCategoryWithDays', compact('leaveCategories'));
    }

    //insert leave category 
    function insertAndUpdateLeaveCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
            'leave_days' => 'required',
        ]);

        if ($validator->fails()) {
            
            $notification = ([
                'error' => 'Something is wrong. Please Fill all the fill carefully',
            ]);

            return redirect()->back()
            ->withErrors($validator)
            ->withInput()->with($notification);
        }
        if (!empty($request->id)) {
            LeaveCategory::findOrFail($request->id)->update([
                'category_name'=> $request->category_name,
                'leave_days'=> $request->leave_days,
            ]);
            $notification = ([
                'success' => 'Leave Category Updated Successfully',
            ]);
        } else {
            LeaveCategory::create([
                'category_name'=> $request->category_name,
                'leave_days'=> $request->leave_days,
            ]);
            
            $notification = ([
                'success' => 'Leave Category Inserted Successfully',
            ]);
        }
        
        return redirect()->back()->with($notification);
                                  
    }

    // delete leave category
    function leaveCategoryDelete($categoryId){
        LeaveCategory::findOrfail($categoryId)->update(['status'=>0]);
        return redirect()->back();
    }


    // leave application store 

    function leave_application_store(Request $request){
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'phone' => 'required',
            'leave_taken' => 'required',
            'leave_category_id' => 'required',
            'application' => 'required',
        ], [
            'start_date.required' => 'Please Enter This Field!',
            'end_date.required' => 'Please Enter This Field!',
            'phone.required' => 'Please Enter This Field!',
            'leave_taken.required' => 'Please Enter This Field!',
            'leave_category_id.required' => 'Please Enter This Field!',
            'application.required' => 'Please Enter This Field!',
        ]);

       $application =  LeaveApplication::create([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'phone' => $request->phone,
            'application' => $request->application,
            'created_by' => Auth::id(),
        ]);
        $count = count($request->leave_category_id);
        for ($i=0; $i < $count ; $i++) { 
            LeaveTaken::create([
                'leave_application_id' => $application->id,
                'leave_category_id' => $request->leave_category_id[$i],
                'leave_taken' => $request->leave_taken[$i],
                'created_by' => Auth::id(),
            ]);
        }
        
        $notification = ([
            'success' => 'Your Application Is Processing !',
        ]);

        return redirect()->back()->with($notification);
    }

    // leave category ajax
    // function leaveCategoryAjax(Request $request){
    //     // $leaveDay = LeaveDay::where("leave_category_id", $request->leaveCat)->value('leave_days');
    //     // return response()->json($leaveDay);
    // }

    // leave application list

    function apply_employee_leave(){
        $leaveCategories = LeaveCategory::orderBy('id', 'desc')->where('status', 1)->paginate(10);
        $LeaveApplications = LeaveApplication::orderBy("id", 'desc')->where("status", 1)->paginate(10);
        return view('backend.theme.clasic.employeeLeave.applyleaveApplication',
         compact(
             'LeaveApplications',
             'leaveCategories'
            ));
    }

    // application print

    function applicationPrint($application_id){
        $leaves = LeaveCategory::orderBy('id', 'desc')->where("status", 1)->get();
        $LeaveApplication = LeaveApplication::findOrFail($application_id);
        return view('backend.theme.clasic.employeeLeave.printApplication', compact('LeaveApplication','leaves'));
    }

    // application approve
    function approveApplication($application_id){
        $LeaveApplication = LeaveApplication::findOrFail($application_id)->update(['approve_status'=> 1]);
        return redirect()->back();
    }
    // application deny
    function denyApplication($application_id){
        $LeaveApplication = LeaveApplication::findOrFail($application_id)->update(['approve_status'=> 0]);
        return redirect()->back();
    }
    

}
