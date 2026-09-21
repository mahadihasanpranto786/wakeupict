<?php

namespace App\Http\Controllers\backend\theme\clasic\payroll;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\EmployeeMonthlySalary;
use App\model\Expense;
use App\model\Payroll;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PayrollController extends Controller
{

    //**********************************************employee monthly salary start************************************** */
    function employeeMonthlySalaryInsert(Request $request){
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'monthly_salary' => 'required',
        ]);

        if ($validator->fails()) {
            
            $notification = ([
                'error' => 'Something is wrong. Please Fill all the fill carefully',
            ]);

            return redirect()->back()
            ->withErrors($validator)
            ->withInput()->with($notification);
        }
        $is_exists=EmployeeMonthlySalary::where('employee_id', $request->employee_id)->first();

        
        if ($is_exists == null && $is_exists == '') {
            EmployeeMonthlySalary::create([
                'employee_id' => $request->employee_id,
                'monthly_salary' => $request->monthly_salary,
            ]);
            
        $notification = ([
            'success' => 'Month Salary Added Successfully',
        ]);
        } else {
          
                $notification = ([
                    'error' => 'Sorry! This Employee Salary Already Exists.',
                ]);
        }
        
        
        return redirect()->back()->with($notification);
    }
    function employeeMonthlySalaryUpdate(Request $request){
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'monthly_salary' => 'required',
        ]);

        if ($validator->fails()) {
            
            $notification = ([
                'error' => 'Something is wrong. Please Fill all the fill carefully',
            ]);

            return redirect()->back()
            ->withErrors($validator)
            ->withInput()->with($notification);
        }
        
        EmployeeMonthlySalary::findOrFail($request->id)->update([
            'employee_id' => $request->employee_id,
            'monthly_salary' => $request->monthly_salary,
        ]);
        
        $notification = ([
            'success' => 'Month Salary Updated Successfully',
        ]);
        return redirect()->back()->with($notification);

      
    }
      //delete salary of the employee
    function employeeMonthlySalaryDelete($salary_id){
        EmployeeMonthlySalary::findOrFail($salary_id)->update([
            'status' => 0,
        ]);
        return redirect()->back();
    }
       // employee salaries 
       function employeeSalaries(){
           
        $employeeSalaries = EmployeeMonthlySalary::with('employee')->where('status',1)->paginate(10);
        $chartSalary = EmployeeMonthlySalary::with('employee')->where('status',1)->get();
        $users = User::where('type','!=','Admin')
                    ->where('type', '!=', 'Moderator')
                    ->where('employee_type', 'Paid')->get();
        return view('backend.theme.clasic.payroll.employee_salaries.index_employee_salaries', compact('users','employeeSalaries','chartSalary'));
    }


    public function generatePayrollStatusAjax(Request $request)
    {
        EmployeeMonthlySalary::findOrFail($request->id)->update(['generate_payroll_status'=>$request->generate_payroll_status]);

        if ($request->generate_payroll_status == 0) {   
            $notification = ([
                'error' => 'Inactive Generate Payroll Status!',
            ]);
        } else {   
            $notification = ([
                'success' => 'Active Generate Payroll Status!',
            ]);
        }
             
        return response()->json($notification);
    }

    public function generatePayroll(Request $request)
    {
        $payrolls = DB::select("SELECT  date(`salary_month`) as salary_month,  count(id) as data  FROM `payrolls` group BY salary_month ORDER BY salary_month DESC");
        
        $payrolls = $this->paginate($payrolls);

        $payrolls->withPath(url('/generate-payroll'));
    
        return view('backend.theme.clasic.payroll.generate_payroll', compact('payrolls'));
    }


    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($items);
        $currentpage = $page;
        $offset = ($currentpage * $perPage) - $perPage ;
        $itemstoshow = array_slice($items , $offset , $perPage);
        return new LengthAwarePaginator($itemstoshow ,$total   ,$perPage);
    }


    public function storeGeneratePayroll(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'salary_month' => 'required|date',
            'payroll_type' => 'required',
            'title_id' => 'required',
            'remark' => 'required',
        ], [
            'date.required' => 'Please Enter Payment Date',
            'salary_month.required' => 'Please Enter Salary Date',
            'payroll_type.required' => 'Please Enter Payroll Type',
            'title_id.required' => 'Please Select Category',
            'remark.required' => 'Please Enter Remark',
        ]);

        $year = Carbon::parse($request->salary_month)->format('Y');
        $month = Carbon::parse($request->salary_month)->format('m');

        $employees = EmployeeMonthlySalary::where('generate_payroll_status',1)->get();

        foreach ($employees as $employee) {
            
        $payroll =  Payroll::where('status', 1)
            ->whereMonth('salary_month',$month)
            ->whereYear('salary_month', $year)
            ->where('user_id', $employee->employee_id)
            ->first();

        if ($payroll == null) {

            $expense_id =  Expense::insertGetId([
                'title_id' => $request->title_id, //dynamic category
                'title' => "Salary Paid From Payroll", //static category
                'expense_type'=> $request->payroll_type, //dynamic category title_id
                'date' => $request->date,
                'remark' => $request->remark,
                'amount' => $employee->monthly_salary,
                'status' => 1,
                'created_at' => Carbon::now(),
            ]);

            Payroll::insert([
                'user_id' => $employee->employee_id,
                'expense_id' =>  $expense_id,
                'title_id' => $request->title_id,
                'employee_type' => 'Paid',
                'date' => $request->date,
                'salary_month' => $request->salary_month,
                'amount' =>  $employee->monthly_salary,
                'remark' => $request->remark,
                'type' => 'Salary',
                'payroll_type' => $request->payroll_type,
                'status' => 1,
                'created_at' => Carbon::now(),
            ]);
            
        }
          

        }

        $notification = ([
            'success' => 'Employee Paid Success',
        ]);
        return redirect('generate-payroll')->with($notification);
    }

    public function generatePayslip(Request $request)
    {
        $year = Carbon::parse($request->salary_month)->format('Y');
        $month = Carbon::parse($request->salary_month)->format('m');

        if (user(Auth::id()) == 1) {
            $payrolls =  Payroll::where('status', 1)
            ->whereMonth('salary_month',$month)
            ->whereYear('salary_month', $year)
            ->where("payroll_type", 'Local')
            ->get();
        }
        elseif (user(Auth::id()) == 2) {
            $payrolls =  Payroll::where('status', 1)
            ->whereMonth('salary_month',$month)
            ->whereYear('salary_month', $year)
            ->where("payroll_type", 'Global')
            ->get();
        }
         else {
            $payrolls =  Payroll::where('status', 1)
            ->whereMonth('salary_month',$month)
            ->whereYear('salary_month', $year)
            ->get();
        }
        return view('backend.theme.clasic.payroll.generate_payroll_slip', compact('payrolls'));
    }
    //**********************************************employee monthly salary start************************************** */
   
    //index payroll

    function indexPayroll()
    {
        $user = User::findOrFail(Auth::id());
        if ($user->excess_type == 1) {
            $payrolls = Payroll::with('user')->latest()
                                ->where('status', 1)
                                ->where('payroll_type','Local')
                                ->paginate(10);
        }
        elseif ($user->excess_type == 2) {
           $payrolls = Payroll::with('user')->latest()
                                ->where('status', 1)
                                ->where('payroll_type','Global')
                                ->paginate(10);
        }
        else {
           $payrolls = Payroll::with('user')->latest()->where('status', 1)->paginate(10);
        }
        
        return view('backend.theme.clasic.payroll.payroll_list', compact('payrolls'));
    }
    //print payroll
    function viewPayroll($payroll_id){
        $payroll = Payroll::with('user')->findOrFail($payroll_id);
        return view('backend.theme.clasic.payroll.payroll_view', compact('payroll'));
    }
    //add payroll
    function addPayroll()
    {
        return view('backend.theme.clasic.payroll.add_payroll');
    }
    //ajax
    function ajaxPayrollEmployee(Request $request){
        $users = User::where('type','!=','Admin')
                    ->where('type', '!=', 'Moderator')
                    ->where('employee_type', $request->employeeType)->get();
        return response()->json($users);
    }

    function ajaxPayrollEmployeeSalary(Request $request){
        $salary = EmployeeMonthlySalary::where('status',1)
                           ->where('employee_id', $request->user_id)
                           ->first();
        return response()->json($salary);
    }
 

    // store payroll with expense

    function storePayroll(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'date' => 'required|date',
            'salary_month' => 'required|date',
            'employee_type' => 'required',
            'amount' => 'required',
            'remark' => 'required',
            'type' => 'required',
            'payroll_type' => 'required',
        ], [
            'user_id.required' => 'Please Enter Employee Name!',
            'date.required' => 'Please Enter Payment Date',
            'salary_month.required' => 'Please Enter Salary Date',
            'employee_type.required' => 'Please Enter this field',
            'amount.required' => 'Please Enter Amount',
            'remark.required' => 'Please Enter Remark',
            'type.required' => 'Please Enter Type',
            'payroll_type.required' => 'Please Enter Payroll Type',
        ]);

        $expense_id =  Expense::insertGetId([
            'title_id' => $request->title_id, //dynamic category
            'title' => "Salary Paid From Payroll", //static category
            'expense_type'=> $request->payroll_type, //dynamic category title_id
            'date' => $request->date,
            'remark' => $request->remark,
            'amount' => $request->amount,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        Payroll::insert([
            'user_id' => $request->user_id,
            'expense_id' =>  $expense_id,
            'title_id' => $request->title_id,
            'employee_type' => $request->employee_type,
            'date' => $request->date,
            'salary_month' => $request->salary_month,
            'amount' => $request->amount,
            'remark' => $request->remark,
            'type' => $request->type,
            'payroll_type' => $request->payroll_type,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);


        $notification = ([
            'success' => 'Employee Paid Success',
        ]);
        return redirect()->route('payroll-list')->with($notification);
    }

    //edit payroll

    function editPayroll($payroll_id)
    {
        $users = User::latest()->get();
        $payroll = Payroll::with('user')->findOrFail($payroll_id);
        return view('backend.theme.clasic.payroll.edit_payroll', compact('payroll', 'users'));
    }

    // update payroll with expense
    function updatePayroll(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'date' => 'required|date',
            'salary_month' => 'required|date', 
            'employee_type' => 'required',
            'amount' => 'required',
            'remark' => 'required',
            'type' => 'required',
            'payroll_type' => 'required',
        ], [
            'user_id.required' => 'Please Enter Employee Name!',
            'date.required' => 'Please Enter Payment Date',
            'salary_month.required' => 'Please Enter Salary Date',
            'employee_type.required' => 'Please Enter this field',
            'amount.required' => 'Please Enter Amount',
            'remark.required' => 'Please Enter Remark',
            'type.required' => 'Please Enter Type',
            'payroll_type.required' => 'Please Enter Payroll Type',
        ]);
        $payroll_id = $request->id;
        $expense_id = $request->expense_id;
        Expense::findOrFail($expense_id)->update([
            'title_id' => $request->title_id, //dynamic category
            'title' => "Salary Paid From Payroll", //static category
            'expense_type'=> $request->payroll_type, //dynamic category title_id
            'date' => $request->date,
            'remark' => $request->remark,
            'amount' => $request->amount,
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);

        Payroll::findOrFail($payroll_id)->update([
            'user_id' => $request->user_id,
            'expense_id' =>  $expense_id,
            'title_id' => $request->title_id,
            'employee_type' => $request->employee_type,
            'date' => $request->date,
            'salary_month' => $request->salary_month,
            'amount' => $request->amount,
            'remark' => $request->remark,
            'type' => $request->type,
            'payroll_type' => $request->payroll_type,
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);


        $notification = ([
            'success' => 'Salary Updated Successfully',
        ]);
        return redirect()->route('payroll-list')->with($notification);
    }

    //delete payroll and expense

    function deletePayroll($payroll_id)
    {
        $payroll = Payroll::findOrFail($payroll_id);
        Expense::findOrFail($payroll->expense_id)->update(['status'=> 0]);
        $payroll->update(['status'=> 0]);
        return redirect()->back();
    }

    //payroll search 

    function payrollSearch(Request $request){
        $month = $request->month;
        $year = $request->year;
        if (user(Auth::id()) == 1) {
            $payrolls =  Payroll::where('status', 1)
            ->whereMonth('date',$month)
            ->whereYear('date', $year)
            ->where("payroll_type", 'Local')
            ->paginate(10);
        }
        elseif (user(Auth::id()) == 2) {
            $payrolls =  Payroll::where('status', 1)
            ->whereMonth('date',$month)
            ->whereYear('date', $year)
            ->where("payroll_type", 'Global')
            ->paginate(10);
        }
         else {
            $payrolls =  Payroll::where('status', 1)
            ->whereMonth('date',$month)
            ->whereYear('date', $year)
            ->paginate(10);
        }
        
     

        return view('backend.theme.clasic.payroll.search_paroll_page', compact('payrolls','month','year'));
    }

    //print searched payroll
    function printSearchedPayroll($month, $year){
        $payrolls =  Payroll::where('status', 1)
                    ->whereMonth('date',$month)
                    ->whereYear('date', $year)
                    ->get();
        return view('backend.theme.clasic.payroll.printSearchedPayroll', compact('payrolls'));
    }
}