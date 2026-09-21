<?php

namespace App\Http\Controllers\backend\theme\clasic\accounts;

use App\model\Asset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\AccountCategory;
use App\model\AssetType;
use App\model\Batch;
use App\model\Expense;
use App\model\ExpensePayback;
use App\model\Income;
use App\model\Investment;
use App\model\Investor;
use App\model\InvestorType;
use App\model\Loan;
use App\model\MultipleExpense;
use App\model\Payroll;
use App\model\StudentPayment;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    //middleware

    public function __construct()
    {
        $this->middleware('auth');
    }
    //**************************************************** start accounts category********************************************************** */
    //index account category
    function indexCategory()
    {
        if (user(Auth::id()) == 1) {
            $categories = AccountCategory::where('type', '!=', 'Static')
                ->where('status', 1)
                ->where('type', 'Local')
                ->orderBy('id', 'DESC')
                ->paginate(20);
        } elseif (user(Auth::id()) == 2) {
            $categories = AccountCategory::where('type', '!=', 'Static')
                ->where('status', 1)
                ->where('type', 'Global')
                ->orderBy('id', 'DESC')
                ->paginate(20);
        } else {
            $categories = AccountCategory::where('type', '!=', 'Static')
                ->where('status', 1)
                ->orderBy('id', 'DESC')
                ->paginate(20);
        }

        return view('backend.theme.clasic.accounts.category.account_category', compact('categories'));
    }
    //create category
    function createCategory()
    {
        $categories = AccountCategory::latest()->where('status', 1)->paginate(10);
        return view('backend.theme.clasic.accounts.category.account_category', compact('categories'));
    }
    //insert category

    function insertCategory(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'account_type' => 'required',
            'type' => 'required',
        ], [
            'title.required' => 'Please Enter This Filed!',
            'account_type.required' => 'Please Enter This Filed!',
            'type.required' => 'Please Enter This Filed!',
        ]);

        AccountCategory::insert([
            'title' => $request->title,
            'account_type' => $request->account_type,
            'type' => $request->type,
            'status' => 1,
            'created_at' => Carbon::now(),

        ]);
        $notification = ([
            'success' => 'Category Inserted Successfully',
        ]);
        return redirect()->back()->with($notification);
    }

    //edit category

    function editCategory($category_id)
    {
        $category_edit =  AccountCategory::findOrFail($category_id);
        $categories = AccountCategory::latest()->where('status', 1)->paginate(10);
        return view('backend.theme.clasic.accounts.category.edit_account_category', compact('category_edit', 'categories'));
    }

    // update category
    function updateCategory(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'account_type' => 'required',
            'type' => 'required',
        ], [
            'title.required' => 'Please Enter This Filed!',
            'account_type.required' => 'Please Enter This Filed!',
            'type.required' => 'Please Enter This Filed!',
        ]);
        $category_id = $request->id;

        AccountCategory::findOrFail($category_id)->update([
            'title' => $request->title,
            'account_type' => $request->account_type,
            'type' => $request->type,
            'status' => 1,
            'updated_at' => Carbon::now(),

        ]);
        $notification = ([
            'success' => 'Category Updated Successfully',
        ]);
        return redirect()->route('accounts-category')->with($notification);
    }


    function deletedCategory($category_id)
    {
        AccountCategory::findOrFail($category_id)->update(['status' => 0]);

        Expense::where('title_id', $category_id)->update(['status' => 0]);
        return redirect()->back();
    }

    public function categoryReport()
    {

        $globalExpenseCategory = AccountCategory::where('type', '!=', 'Static')
            ->where('status', 1)
            ->where('type', 'Global')
            ->where('account_type', 'Expense')
            ->orderBy('id', 'DESC')
            ->get();

        $globalIncomeCategory = AccountCategory::where('type', '!=', 'Static')
            ->where('status', 1)
            ->where('type', 'Global')
            ->where('account_type', 'Income')
            ->orderBy('id', 'DESC')
            ->get();


        $localExpenseCategory = AccountCategory::where('type', '!=', 'Static')
            ->where('status', 1)
            ->where('type', 'Local')
            ->where('account_type', 'Expense')
            ->orderBy('id', 'DESC')
            ->get();

        $localIncomeCategory = AccountCategory::where('type', '!=', 'Static')
            ->where('status', 1)
            ->where('type', 'Local')
            ->where('account_type', 'Income')
            ->orderBy('id', 'DESC')
            ->get();

        return view('backend.theme.clasic.accounts.category.category_report', compact(
            'globalExpenseCategory',
            'globalIncomeCategory',
            'localExpenseCategory',
            'localIncomeCategory'
        ));
    }
    //**************************************************** end accounts category********************************************************** */


    //******************************************************* start expense********************************************************** */
    //index expense

    function indexExpense()
    {
        $user = User::findOrFail(Auth::id());
        if ($user->excess_type == 1) {
            $expenses = Expense::with('category')->latest()
                ->where(['status' => 1, 'expense_type' => 'Local'])
                ->paginate(10);
        } elseif ($user->excess_type == 2) {
            $expenses = Expense::with('category')->latest()
                ->where(['status' => 1, 'expense_type' => 'Global'])
                ->paginate(10);
        } else {
            $expenses = Expense::with('category')->latest()->where('status', 1)->paginate(10);
        }

        return view('backend.theme.clasic.accounts.expense.expense_list', compact('expenses'));
    }
    //add expense
    function addExpense()
    {
        return view('backend.theme.clasic.accounts.expense.add_expense');
    }

    // add multiple expense
    function addMultipleExpense()
    {
        return view('backend.theme.clasic.accounts.expense.add_multiple_expense');
    }

    // store expense

    function storeExpense(Request $request)
    {
        $request->validate([
            'expense_type' => 'required',
            'title_id' => 'required',
            'title' => 'required',
            'date' => 'required|date',
            'remark' => 'required|max:500',
            'amount' => 'required|numeric',
        ], [
            'expense_type.required' => 'Please Enter This Filed!',
            'title_id.required' => 'Please Enter This Filed!',
            'title.required' => 'Please Enter This Filed!',
            'date.required' => 'Please Enter This Filed!',
            'remark.required' => 'Please Enter This Filed!',
            'amount.required' => 'Please Enter This Filed!',
        ]);

        Expense::insert([
            'expense_type' => $request->expense_type,
            'title_id' => $request->title_id,
            'title' => $request->title,
            'date' => $request->date,
            'remark' => $request->remark,
            'amount' => $request->amount,
            'status' => 1,
            'created_at' => Carbon::now(),

        ]);
        $notification = ([
            'success' => 'Expense Stored Successfully',
        ]);
        return redirect()->route('expenses-list')->with($notification);
    }

    //edit expense and payroll

    function editExpense($expense_id)
    {
        $expense = Expense::with('category')->findOrFail($expense_id);

        $payroll = Payroll::where('expense_id', $expense_id)->where('status', 1)->first();
        if ($payroll) {
            $users = User::latest()->get();
            $payroll = Payroll::findOrFail($payroll->id);
            return view('backend.theme.clasic.payroll.edit_payroll', compact('payroll', 'users'));
        } else {
            return view('backend.theme.clasic.accounts.expense.edit_expense', compact('expense'));
        }
    }

    //update expense

    function updateExpense(Request $request)
    {
        $request->validate([
            'expense_type' => 'required',
            'title_id' => 'required',
            'title' => 'required',
            'date' => 'required|date',
            'remark' => 'required|max:500',
            'amount' => 'required|numeric',
        ], [
            'expense_type.required' => 'Please Enter This Filed!',
            'title_id.required' => 'Please Enter This Filed!',
            'title.required' => 'Please Enter This Filed!',
            'date.required' => 'Please Enter This Filed!',
            'remark.required' => 'Please Enter This Filed!',
            'amount.required' => 'Please Enter This Filed!',
        ]);
        $expense_id = $request->id;
        Expense::findOrFail($expense_id)->update([
            'expense_type' => $request->expense_type,
            'title_id' => $request->title_id,
            'title' => $request->title,
            'date' => $request->date,
            'remark' => $request->remark,
            'amount' => $request->amount,
            'status' => 1,
            'updated_at' => Carbon::now(),

        ]);
        $paybackExpense =  ExpensePayback::where("expense_id", $expense_id)->where('status', 1)->get();
        if (count($paybackExpense) > 0) {
            foreach ($paybackExpense as $payback) {
                ExpensePayback::where("id", $payback->id)->update(['expense_date' => $request->date]);
            }
        }
        $notification = ([
            'success' => 'Expense Updated Successfully',
        ]);
        return redirect()->route('expenses-list')->with($notification);
    }

    // delete expense with payroll

    function deleteExpense($expense_id)
    {
        $payroll =  Payroll::where('expense_id', $expense_id)->where('status', 1)->first();
        if ($payroll) {
            Payroll::findOrFail($payroll->id)->update(['status' => 0]);
            Expense::findOrFail($expense_id)->update(['status' => 0]);
            return redirect()->back();
        } else {
            Expense::findOrFail($expense_id)->update(['status' => 0]);
            ExpensePayback::where('expense_id', $expense_id)->update(['status' => 0]);
            return redirect()->back();
        }
    }

    function viewExpense($expense_id)
    {
        $expense = Expense::with('category')->findOrFail($expense_id);
        return view('backend.theme.clasic.accounts.expense.expense_view', compact('expense'));
    }

    // expense payback
    function expensePayback(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payback_money' => 'required',
            'remark' => 'required',
        ]);

        if ($validator->fails()) {

            $notification = ([
                'error' => 'Something is wrong. Please Fill all the fields carefully',
            ]);

            return redirect()->back()
                ->withErrors($validator)
                ->withInput()->with($notification);
        }

        ExpensePayback::create([
            'expense_id' => $request->expense_id,
            'expense_date' => $request->expense_date,
            'payback_money' => $request->payback_money,
            'remark' => $request->remark,
        ]);
        $notification = ([
            'success' => 'Expense Payback Successfully',
        ]);
        return redirect()->back()->with($notification);
    }

    //expense payroll
    function expensePayroll($expense_id)
    {

        $expense = Expense::with('category')->findOrFail($expense_id);
        $payroll = Payroll::where('expense_id', $expense_id)->where('status', 1)->first();
        return view('backend.theme.clasic.accounts.expense.payroll_print', compact('payroll', 'expense'));
    }
    //expense type ajax
    function expenseTypeAjax(Request $request)
    {
        $categories = AccountCategory::where('status', 1)
            ->where('type', $request->expenseType)
            ->where('account_type', 'Expense')
            ->get();

        return response()->json($categories);
    }
    //multiple expense list
    function indexMultipleExpense()
    {
        $user = User::findOrFail(Auth::id());
        if ($user->excess_type == 1) {
            $multiExpenses = MultipleExpense::orderBy("id", 'desc')
                ->where(["status" => 1, 'expense_type' => 'Local'])
                ->paginate(10);
        } elseif ($user->excess_type == 2) {
            $multiExpenses = MultipleExpense::orderBy("id", 'desc')
                ->where(["status" => 1, 'expense_type' => 'Global'])
                ->paginate(10);
        } else {
            $multiExpenses = MultipleExpense::orderBy("id", 'desc')->where("status", 1)->paginate(10);
        }

        return view('backend.theme.clasic.accounts.expense.multiple_expense_list', compact('multiExpenses'));
    }

    //multiple expense print
    function printMutipleExpense($multi_expense_id)
    {
        $multipleExpense = MultipleExpense::findOrFail($multi_expense_id);
        $expenses =  Expense::with('category')
            ->where('multiple_expense_id', $multi_expense_id)
            ->where("status", 1)
            ->get();
        $expensesType =  Expense::with('category')
            ->where('multiple_expense_id', $multi_expense_id)
            ->where("status", 1)
            ->select('expense_type')
            ->groupBy("expense_type")->pluck("expense_type")->first();
        $expenseAmountTotal =  Expense::with('category')
            ->where('multiple_expense_id', $multi_expense_id)
            ->where("status", 1)
            ->sum('amount');
        return view(
            "backend.theme.clasic.accounts.expense.printMultipleExpense",
            compact(
                'expenses',
                'multipleExpense',
                'expensesType',
                'expenseAmountTotal',
            )
        );
    }

    // delete multiple expense
    function DeleteMultipleExpense($multi_expense_id)
    {
        $multipleExpenses =   Expense::where("multiple_expense_id", $multi_expense_id)->where("status", 1)->get();
        foreach ($multipleExpenses as $expense) {
            Expense::findOrFail($expense->id)->update(['status' => 0]);
        }
        MultipleExpense::findOrFail($multi_expense_id)->update(['status' => 0]);
        return redirect()->back();
    }
    //store multiple expense
    function storeMultipleExpense(Request $request)
    {
        $expnseCategory = '';
        foreach ($request->title_id as $category) {
            $expnseCategory .= $category . ',';
        }
        $multiple_expense_id =  MultipleExpense::create([
            'category_id' => $expnseCategory,
            'date' => $request->date,
            'expense_type' => $request->expense_type,
        ]);

        for ($i = 0; $i < count($request->title_id); $i++) {
            Expense::insert([
                'expense_type' => $request->expense_type,
                'title_id' => $request->title_id[$i],
                'title' => $request->title[$i],
                'amount' => $request->amount[$i],
                'date' => $request->date,
                'remark' => $request->remark[$i],
                'status' => 1,
                'multiple_expense_id' => $multiple_expense_id->id,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = ([
            'success' => 'Expense Payback Successfully',
        ]);
        return redirect()->back()->with($notification);
    }

    //******************************************************* end expense********************************************************** */


    //******************************************************* start income********************************************************** */
    //index income

    function indexIncome()
    {
        $user = User::findOrFail(Auth::id());
        if ($user->excess_type == 1) {
            $incomes = Income::latest()
                ->where(["status" => 1, 'income_type' => 'Local'])
                ->paginate(10);
        } elseif ($user->excess_type == 2) {
            $incomes = Income::latest()
                ->where(["status" => 1, 'income_type' => 'Global'])
                ->paginate(10);
        } else {
            $incomes = Income::latest()->where('status', 1)->paginate(10);
        }
        return view('backend.theme.clasic.accounts.income.income_list', compact('incomes'));
    }

    //add income
    function AddIncome()
    {
        $categories = AccountCategory::latest()->where('status', 1)->get();
        return view('backend.theme.clasic.accounts.income.add_income', compact('categories'));
    }


    function storeIncome(Request $request)
    {
        $request->validate([
            'income_type' => 'required',
            'title_id' => 'required',
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'remark' => 'required|max:500',
            'amount' => 'required|numeric',
        ], [
            'income_type.required' => 'Please Enter This Filed!',
            'title_id.required' => 'Please Enter This Filed!',
            'title.required' => 'Please Enter This Filed!',
            'date.required' => 'Please Enter This Filed!',
            'remark.required' => 'Please Enter This Filed!',
            'amount.required' => 'Please Enter This Filed!',
        ]);

        Income::insert([
            'income_type' => $request->income_type,
            'title_id' => $request->title_id,
            'title' => $request->title,
            'date' => $request->date,
            'remark' => $request->remark,
            'amount' => $request->amount,
            'status' => 1,
            'created_at' => Carbon::now(),

        ]);
        $notification = ([
            'success' => 'Income Stored Successfully',
        ]);
        return redirect()->route('income-list')->with($notification);
    }


    //edit income

    function editIncome($income_id)
    {

        $income = Income::findOrFail($income_id);
        $studentPayment = StudentPayment::where('income_id', $income_id)->where('status', 1)->first();
        if ($studentPayment) {
            $income = Income::findOrFail($income_id);
            return view('backend.theme.clasic.accounts.income.edit_income_with_student_payment', compact('income'));
        } else {
            $categories = AccountCategory::latest()->where('status', 1)->get();
            $income = Income::findOrFail($income_id);
            return view('backend.theme.clasic.accounts.income.edit_income', compact('income', 'categories'));
        }
    }


    //update income

    function updateIncome(Request $request)
    {
        $request->validate([
            'income_type' => 'required',
            'title_id' => 'required',
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'remark' => 'required|max:500',
            'amount' => 'required|numeric',
        ], [
            'income_type.required' => 'Please Enter This Filed!',
            'title_id.required' => 'Please Enter This Filed!',
            'title.required' => 'Please Enter This Filed!',
            'date.required' => 'Please Enter This Filed!',
            'remark.required' => 'Please Enter This Filed!',
            'amount.required' => 'Please Enter This Filed!',
        ]);
        $income_id = $request->id;
        Income::findOrFail($income_id)->update([
            'income_type' => $request->income_type,
            'title_id' => $request->title_id,
            'title' => $request->title,
            'date' => $request->date,
            'remark' => $request->remark,
            'amount' => $request->amount,
            'status' => 1,
            'updated_at' => Carbon::now(),

        ]);
        $notification = ([
            'success' => 'Income Updated Successfully',
        ]);
        return redirect()->route('income-list')->with($notification);
    }


    //delete income
    function deleteIncome($income_id)
    {

        $income = Income::findOrFail($income_id);

        $studentPayment = StudentPayment::where('income_id', $income_id)->where('status', 1)->first();

        if ($studentPayment) {
            $studentPayment->update(['status' => 0]);
            Income::findOrFail($income_id)->update(['status' => 0]);
            return redirect()->back();
        } else {
            Income::findOrFail($income_id)->update(['status' => 0]);
            return redirect()->back();
        }
    }

    function viewIncome($income_id)
    {
        $income = Income::with('category')->findOrFail($income_id);
        return view('backend.theme.clasic.accounts.income.income_view', compact('income'));
    }
    //income type ajax
    function incomeTypeAjax(Request $request)
    {
        $categories = AccountCategory::where('status', 1)
            ->where('type', $request->incomeType)
            ->where('account_type', 'Income')
            ->get();
        return response()->json($categories);
    }

    function updateIncomeStudentPayment(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'remark' => 'required|max:500',
            'amount' => 'required|numeric',
        ], [
            'date.required' => 'Please Enter This Field!',
            'remark.required' => 'Please Enter This Field!',
            'amount.required' => 'Please Enter This Field!',
        ]);
        $income =  StudentPayment::where("income_id", $request->id)->first();
        $batch = Batch::findOrFail($income->batch_id);
        Income::findOrFail($request->id)->update([
            'title_id' => $batch->title_id, //dynamic category
            'title' => "Student Admission Fee",
            'date' => $request->date,
            'remark' => $request->remark,
            'amount' => $request->amount,
            'status' => 1,
        ]);

        StudentPayment::findOrFail($income->id)->update([
            'date' => $request->date,
            'remark' => $request->remark,
            'paid' => $request->amount,
        ]);

        $notification = ([
            'success' => 'Payment Updated Successfully',
        ]);
        return redirect()->route('income-list')->with($notification);
    }

    ///student income form income

    function incomeStudentPayment($payment_id)
    {
        $static = 'Static';
        $payment = StudentPayment::with('course')->with('student')->findOrFail($payment_id);
        $previousPaid = StudentPayment::where('id', '<', $payment->id)
            ->where('student_id', $payment->student_id)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->limit(1)
            ->first();
        if ($previousPaid == null) {
            return view('backend.theme.clasic.accounts.income.studentPaymentIncome', compact('payment', 'static'));
        } else {
            return view('backend.theme.clasic.accounts.income.studentRepaymentIncome', compact('payment', 'static'));
        }
    }

    //******************************************************* end income********************************************************** */



    //*************************************************** */ monthly sheet start ******************************************************

    function monthlySheet()
    {
        $currentYear = Carbon::now()->format('Y');
        $currentMonth = Carbon::now()->format('m');
        $user = User::findOrFail(Auth::id());
        if ($user->excess_type == 1) {
            $sumExpense = Expense::where(["status" => 1, 'expense_type' => 'Local'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->sum('amount') - ExpensePayback::select('payback_money')
                ->where('status', 1)
                ->whereYear('expense_date', '=', $currentYear)
                ->whereMonth('expense_date', '=', $currentMonth)
                ->sum('payback_money');

            $sumIncome = Income::where(["status" => 1, 'income_type' => 'Local'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->sum('amount');

            $expenses = Expense::where(["status" => 1, 'expense_type' => 'Local'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->get();

            $incomes = Income::where(["status" => 1, 'income_type' => 'Local'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->get();
        } elseif ($user->excess_type == 2) {
            $sumExpense = Expense::where(["status" => 1, 'expense_type' => 'Global'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->sum('amount') - ExpensePayback::select('payback_money')
                ->where('status', 1)
                ->whereYear('expense_date', '=', $currentYear)
                ->whereMonth('expense_date', '=', $currentMonth)
                ->sum('payback_money');

            $sumIncome = Income::where(["status" => 1, 'income_type' => 'Global'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->sum('amount');

            $expenses = Expense::where(["status" => 1, 'expense_type' => 'Global'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->get();

            $incomes = Income::where(["status" => 1, 'income_type' => 'Global'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->get();
        } else {
            $sumExpense = Expense::where('status', 1)
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->sum('amount') - ExpensePayback::select('payback_money')
                ->where('status', 1)
                ->whereYear('expense_date', '=', $currentYear)
                ->whereMonth('expense_date', '=', $currentMonth)
                ->sum('payback_money');

            $sumIncome = Income::where('status', 1)
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->sum('amount');

            $expenses = Expense::where('status', 1)
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->get();

            $incomes = Income::where('status', 1)
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->get();
        }

        return view(
            'backend.theme.clasic.accounts.monthly_sheet.monthly_sheet',
            compact(
                'incomes',
                'expenses',
                'sumExpense',
                'sumIncome'
            )
        );
    }

    //search monthly sheet

    function monthlySheetSearch(Request $request)
    {
        $month = $request->month;

        $year =  $request->year;

        $sumExpense = Expense::where('status', 1)->whereYear('date', '=', $year)
            ->whereMonth('date', '=', $month)->sum('amount') - ExpensePayback::select('payback_money')
            ->whereYear('expense_date', '=', $year)
            ->whereMonth('expense_date', '=', $month)
            ->where('status', 1)
            ->sum('payback_money');

        $sumIncome = Income::where('status', 1)->whereYear('date', '=', $year)
            ->whereMonth('date', '=', $month)->sum('amount');

        $expenses = Expense::where('status', 1)->whereYear('date', '=', $year)
            ->whereMonth('date', '=', $month)->get();

        $incomes = Income::where('status', 1)->whereYear('date', '=', $year)
            ->whereMonth('date', '=', $month)->get();

        $search_date = DateTime::createFromFormat('m-Y', $month . '-' . $year);
        return view(
            'backend.theme.clasic.accounts.monthly_sheet.monthly_sheet',
            compact(
                'incomes',
                'expenses',
                'sumExpense',
                'sumIncome',
                'year',
                'search_date'
            )
        );
    }

    //    montly sheet print

    function monthlySheetPrint()
    {
        $currentYear = Carbon::now()->format('Y');
        $currentMonth = Carbon::now()->format('m');
        if (user(Auth::id()) == 1) {
            $sumExpense = Expense::where(['status' => 1, 'expense_type' => 'Local'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->sum('amount') - ExpensePayback::select('payback_money')
                ->where('status', 1)
                ->whereYear('expense_date', '=', $currentYear)
                ->whereMonth('expense_date', '=', $currentMonth)
                ->sum('payback_money');

            $sumIncome = Income::where(['status' => 1, 'income_type' => 'Local'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->sum('amount');

            $expenses = Expense::where(['status' => 1, 'expense_type' => 'Local'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->get();

            $incomes = Income::where(['status' => 1, 'income_type' => 'Local'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->get();
        } elseif (user(Auth::id()) == 2) {
            $sumExpense = Expense::where(['status' => 1, 'expense_type' => 'Global'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->sum('amount') - ExpensePayback::select('payback_money')
                ->where('status', 1)
                ->whereYear('expense_date', '=', $currentYear)
                ->whereMonth('expense_date', '=', $currentMonth)
                ->sum('payback_money');

            $sumIncome = Income::where(['status' => 1, 'income_type' => 'Global'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->sum('amount');

            $expenses = Expense::where(['status' => 1, 'expense_type' => 'Global'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->get();

            $incomes = Income::where(['status' => 1, 'income_type' => 'Global'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->get();
        } else {
            $sumExpense = Expense::where('status', 1)
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->sum('amount') - ExpensePayback::select('payback_money')
                ->where('status', 1)
                ->whereYear('expense_date', '=', $currentYear)
                ->whereMonth('expense_date', '=', $currentMonth)
                ->sum('payback_money');

            $sumIncome = Income::where('status', 1)
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->sum('amount');

            $expenses = Expense::where('status', 1)
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->get();

            $incomes = Income::where('status', 1)
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->get();
        }


        return view(
            'backend.theme.clasic.accounts.monthly_sheet.monthly_sheet_print',
            compact(
                'incomes',
                'expenses',
                'sumExpense',
                'sumIncome'
            )
        );
    }

    //searched monthly sheet print
    function searchedMonthlySheetPrint(Request $request)
    {
        $month = Carbon::parse($request->searchedDate)->format('m');
        $year = Carbon::parse($request->searchedDate)->format('Y');


        $sumExpense = Expense::where('status', 1)->whereYear('date', '=', $year)
            ->whereMonth('date', '=', $month)->sum('amount') - ExpensePayback::select('payback_money')
            ->whereYear('expense_date', '=', $year)
            ->whereMonth('expense_date', '=', $month)
            ->where('status', 1)
            ->sum('payback_money');

        $sumIncome = Income::where('status', 1)->whereYear('date', '=', $year)
            ->whereMonth('date', '=', $month)->sum('amount');

        $expenses = Expense::where('status', 1)->whereYear('date', '=', $year)
            ->whereMonth('date', '=', $month)->get();

        $incomes = Income::where('status', 1)->whereYear('date', '=', $year)
            ->whereMonth('date', '=', $month)->get();

        $search_date = DateTime::createFromFormat('m-Y', $month . '-' . $year);
        return view(
            'backend.theme.clasic.accounts.monthly_sheet.monthly_sheet_print',
            compact(
                'incomes',
                'expenses',
                'sumExpense',
                'sumIncome'
            )
        );
    }
    //*************************************************** */ monthly sheet end ******************************************************

    //*************************************************** */ monthly summary start ******************************************************

    function monthlySummary()
    {

        $currentYear = Carbon::now()->format('Y');
        $currentMonth = Carbon::now()->format('m');

        $currentMonthLoans =  Loan::whereYear('date', '=', $currentYear)
            ->whereMonth('date', '=', $currentMonth)
            ->paginate(5, ['*'], 'loan');

        $currentMonthLoanSum =  Loan::whereYear('date', '=', $currentYear)
            ->whereMonth('date', '=', $currentMonth)
            ->sum('loan_amount');


        if (user(Auth::id()) == 1) {

            $sumExpense = Expense::where(["status" => 1, 'expense_type' => 'Local'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->sum('amount') - ExpensePayback::select('payback_money')
                ->where('status', 1)
                ->whereYear('expense_date', '=', $currentYear)
                ->whereMonth('expense_date', '=', $currentMonth)
                ->sum('payback_money');

            $sumIncome = Income::where(["status" => 1, 'income_type' => 'Local'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->sum('amount');

            $expenses = Expense::where(["status" => 1, 'expense_type' => 'Local'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->get();

            $incomes = Income::where(["status" => 1, 'income_type' => 'Local'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->get();


            //current month summary start
            $currentMonthInvestments =  Investment::where(["status" => 1, 'invest_type' => 'Local'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->paginate(5, ['*'], 'investments');

            $currentMonthInvestmentSum =  Investment::where(["status" => 1, 'invest_type' => 'Local'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->sum('amount');

            $currentMonthAssets =  Asset::where(["status" => 1, 'type' => 'Local'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->paginate(5, ['*'], 'assets');

            $currentMonthAssetSum =  Asset::where(["status" => 1, 'type' => 'Local'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->sum('total_price');
            //current month summary end
        } elseif (user(Auth::id()) == 2) {
            $sumExpense = Expense::where(["status" => 1, 'expense_type' => 'Global'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->sum('amount') - ExpensePayback::select('payback_money')
                ->where('status', 1)
                ->whereYear('expense_date', '=', $currentYear)
                ->whereMonth('expense_date', '=', $currentMonth)
                ->sum('payback_money');

            $sumIncome = Income::where(["status" => 1, 'income_type' => 'Global'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->sum('amount');

            $expenses = Expense::where(["status" => 1, 'expense_type' => 'Global'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->get();

            $incomes = Income::where(["status" => 1, 'income_type' => 'Global'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->get();


            //current month summary start
            $currentMonthInvestments =  Investment::where(["status" => 1, 'invest_type' => 'Global'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->paginate(5, ['*'], 'investments');

            $currentMonthInvestmentSum =  Investment::where(["status" => 1, 'invest_type' => 'Global'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->sum('amount');

            $currentMonthAssets =  Asset::where(["status" => 1, 'type' => 'Global'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->paginate(5, ['*'], 'assets');

            $currentMonthAssetSum =  Asset::where(["status" => 1, 'type' => 'Global'])
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->sum('total_price');
            //current month summary end
        } else {
            $sumExpense = Expense::where('status', 1)
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->sum('amount') - ExpensePayback::select('payback_money')
                ->where('status', 1)
                ->whereYear('expense_date', '=', $currentYear)
                ->whereMonth('expense_date', '=', $currentMonth)
                ->sum('payback_money');

            $sumIncome = Income::where('status', 1)
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->sum('amount');

            $expenses = Expense::where('status', 1)
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->get();

            $incomes = Income::where('status', 1)
                ->whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->get();


            //current month summary start
            $currentMonthInvestments =  Investment::whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->paginate(5, ['*'], 'investments');

            $currentMonthInvestmentSum =  Investment::whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->sum('amount');

            $currentMonthAssets =  Asset::whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->paginate(5, ['*'], 'assets');

            $currentMonthAssetSum =  Asset::whereYear('date', '=', $currentYear)
                ->whereMonth('date', '=', $currentMonth)
                ->sum('total_price');

            //current month summary end

        }

        return view(
            'backend.theme.clasic.accounts.monthly_summary.monthly_summary_index',
            compact(
                'incomes',
                'expenses',
                'sumExpense',
                'sumIncome',
                'currentMonthInvestments',
                'currentMonthAssets',
                'currentMonthLoans',
                'currentMonthInvestmentSum',
                'currentMonthLoanSum',
                'currentMonthAssetSum',
            )
        );
    }
    //*************************************************** */ monthly summary end ******************************************************


    //*************************************************** */ investor start ******************************************************

    function indexInvestor()
    {
        if (user(Auth::id()) == 1) {
            $investors = Investor::orderBy("id", 'desc')
                ->where(['status' => 1, 'type' => 'Local'])
                ->paginate(10);
        } elseif (user(Auth::id()) == 2) {
            $investors = Investor::orderBy("id", 'desc')
                ->where(['status' => 1, 'type' => 'Global'])
                ->paginate(10);
        } else {
            $investors = Investor::orderBy("id", 'desc')
                ->where('status', 1)
                ->paginate(10);
        }

        return view('backend.theme.clasic.accounts.invest.investor.index_investor', compact('investors'));
    }

    function insertInvestor(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'address' => 'required',
            'mobile' => 'required',
        ], [
            'name.required' => 'Please Enter This Filed!',
            'type.required' => 'Please Enter This Filed!',
            'address.required' => 'Please Enter This Filed!',
            'mobile.required' => 'Please Enter This Filed!',
        ]);

        Investor::create([
            'name' => $request->name,
            'type' => $request->type,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'status' => 1,
        ]);

        $notification = ([
            'success' => 'Investor Stored Successfully',
        ]);
        return redirect()->back()->with($notification);
    }

    function updateInvestor(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'address' => 'required',
            'mobile' => 'required',
        ], [
            'name.required' => 'Please Enter This Filed!',
            'type.required' => 'Please Enter This Filed!',
            'address.required' => 'Please Enter This Filed!',
            'mobile.required' => 'Please Enter This Filed!',
        ]);


        Investor::findOrFail($request->id)->update([
            'name' => $request->name,
            'type' => $request->type,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'status' => 1,
        ]);

        $notification = ([
            'success' => 'Investor Updated Successfully',
        ]);
        return redirect()->route('index_investor')->with($notification);
    }

    function deleteInvestor($investor_id)
    {
        Investor::findOrFail($investor_id)->update(['status' => 0]);
        return redirect()->route('index_investor');
    }
    //*************************************************** */ investor end ******************************************************


    //*************************************************** */ investor type start ******************************************************

    function indexInvestorType()
    {
        $investor_type = InvestorType::orderBy("investor_type_name", 'desc')->where('status', 1)->paginate(10);
        return view('backend.theme.clasic.accounts.invest.type.index_investor_type', compact('investor_type'));
    }

    function insertInvestorType(Request $request)
    {
        $request->validate([
            'investor_type_name' => 'required',
        ], [
            'investor_type_name.required' => 'Please Enter This Filed!',
        ]);

        InvestorType::create([
            'investor_type_name' => $request->investor_type_name,
            'status' => 1
        ]);


        $notification = ([
            'success' => 'Investor Type Inserted Successfully',
        ]);
        return redirect()->back()->with($notification);
    }


    function updateInvestorType(Request $request)
    {

        $request->validate([
            'investor_type_name' => 'required',
        ], [
            'investor_type_name.required' => 'Please Enter This Filed!',
        ]);

        InvestorType::findOrFail($request->id)->update([
            'investor_type_name' => $request->investor_type_name,
            'status' => 1
        ]);


        $notification = ([
            'success' => 'Investor Type Updated Successfully',
        ]);
        return redirect()->route('index_investor_type')->with($notification);
    }

    function deleteInvestorType($type_id)
    {
        InvestorType::findOrFail($type_id)->update(['status' => 0]);
        return redirect()->route('index_investor_type');
    }
    //*************************************************** */ investor type end ******************************************************

    //*************************************************** */ investment start ******************************************************

    function investment_list()
    {

        if (user(Auth::id()) == 1) {
            $investments = Investment::with('investor')
                ->with('investorType')
                ->orderBy('id', 'desc')
                ->where(['status' => 1, 'invest_type' => 'Local'])
                ->paginate(10);
        } elseif (user(Auth::id()) == 2) {

            $investments = Investment::with('investor')
                ->with('investorType')
                ->orderBy('id', 'desc')
                ->where(['status' => 1, 'invest_type' => 'Global'])
                ->paginate(10);
        } else {
            $investments = Investment::with('investor')
                ->with('investorType')
                ->orderBy('id', 'desc')
                ->where('status', 1)
                ->paginate(10);
        }
        return view('backend.theme.clasic.accounts.invest.investment.investment_list', compact('investments'));
    }
    //view or print investment
    function viewInvestment($invest_id)
    {
        $invest = Investment::with('investor')->findOrFail($invest_id);
        return view('backend.theme.clasic.accounts.invest.investment.investment_view', compact('invest'));
    }

    //edit investment
    function editInvestment($invest_id)
    {

        $investor_type = InvestorType::where('status', 1)
            ->get();
        $investors = Investor::where(['status' => 1])
            ->get();
        $invest = Investment::with('investor')->findOrFail($invest_id);
        return view(
            'backend.theme.clasic.accounts.invest.investment.editInvestment',
            compact(
                'invest',
                'investors',
                'investor_type'
            )
        );
    }
    //add investment
    function addInvestment()
    {
        if (user(Auth::id()) == 1) {
            $investors = Investor::orderBy("id", 'desc')
                ->where(['status' => 1, 'type' => 'Local'])
                ->get();
        } elseif (user(Auth::id()) == 2) {
            $investors = Investor::orderBy("id", 'desc')
                ->where(['status' => 1, 'type' => 'Global'])
                ->get();
        } else {
            $investors = Investor::orderBy("id", 'desc')
                ->where(['status' => 1])
                ->get();
        }

        $investor_type = InvestorType::orderBy("investor_type_name", 'desc')->where('status', 1)->get();
        return view('backend.theme.clasic.accounts.invest.investment.add_investment', compact('investors', 'investor_type'));
    }

    //store investment
    function storeInvestment(Request $request)
    {
        $request->validate([
            'investor_id' => 'required',
            'investment_type_id' => 'required',
            'amount' => 'required',
            'date' => 'required|date',
            'rate' => 'required|numeric',
            'remark' => 'required|max:500',
        ], [
            'investor_id.required' => 'Please Enter This Filed!',
            'investment_type_id.required' => 'Please Enter This Filed!',
            'amount.required' => 'Please Enter This Filed!',
            'date.required' => 'Please Enter This Filed!',
            'rate.required' => 'Please Enter This Filed!',
            'remark.required' => 'Please Enter This Filed!',
        ]);
        $investor = Investor::findOrFail($request->investor_id);

        Investment::create([
            'investor_id' => $request->investor_id,
            'invest_type' => $investor->type,
            'investment_type_id' => $request->investment_type_id,
            'amount' => $request->amount,
            'date' => $request->date,
            'rate' => $request->rate,
            'remark' => $request->remark,
            'status' => 1,
        ]);

        $notification = ([
            'success' => 'Investment added Successfully',
        ]);
        return redirect()->route('investment_list')->with($notification);
    }

    // update investment

    function updateInvestment(Request $request)
    {

        $request->validate([
            'investor_id' => 'required',
            'investment_type_id' => 'required',
            'amount' => 'required',
            'date' => 'required|date',
            'rate' => 'required|numeric',
            'remark' => 'required|max:500',
        ], [
            'investor_id.required' => 'Please Enter This Filed!',
            'investment_type_id.required' => 'Please Enter This Filed!',
            'amount.required' => 'Please Enter This Filed!',
            'date.required' => 'Please Enter This Filed!',
            'rate.required' => 'Please Enter This Filed!',
            'remark.required' => 'Please Enter This Filed!',
        ]);
        $investor = Investor::findOrFail($request->investor_id);

        Investment::findOrFail($request->id)->update([
            'investor_id' => $request->investor_id,
            'invest_type' => $investor->type,
            'investment_type_id' => $request->investment_type_id,
            'amount' => $request->amount,
            'date' => $request->date,
            'rate' => $request->rate,
            'remark' => $request->remark,
            'status' => 1,
        ]);

        $notification = ([
            'success' => 'Investment Updated Successfully',
        ]);
        return redirect()->route('investment_list')->with($notification);
    }

    //*************************************************** */ investment end ******************************************************

    //*************************************************** cash in hand start ******************************************************

    function CashInHand()
    {

        $sumExpense = Expense::where('status', 1)->sum('amount');

        $sumIncome = Income::where('status', 1)->sum('amount');

        $investment = Investment::where('status', 1)->sum('amount');

        $sumAsset = Asset::where('status', 1)->sum('total_price');

        $sumLoan = Loan::where('status', 1)->sum('loan_amount');

        $expensePaybackSum = ExpensePayback::select('payback_money')
            ->where('status', 1)
            ->sum('payback_money');

        $existExpense = $sumExpense - $expensePaybackSum;
        $cashInHand = $investment + $sumIncome  + $sumLoan - $existExpense - $sumAsset;

        return view('backend.theme.clasic.accounts.cash.cash_in_hand', compact('cashInHand'));
    }
    //*************************************************** cash in hand end ******************************************************

    //*************************************************** asset start ******************************************************
    function assetTypeIndex()
    {
        $assetTypes = AssetType::where("status", 1)->paginate(10);
        return view('backend.theme.clasic.accounts.asset.assetType', compact('assetTypes'));
    }

    function InsertAndUpdateAssetType(Request $request)
    {
        $request->validate([
            'asset_type_name' => 'required',
        ], [
            'asset_type_name.required' => 'Please Enter This Filed!',
        ]);
        if ($request->id) {
            AssetType::findOrFail($request->id)->update([
                'asset_type_name' => $request->asset_type_name,
                'status' => 1,
            ]);
            $notification = ([
                'success' => 'Asset Type Updated Successfully',
            ]);
        } else {
            AssetType::create([
                'asset_type_name' => $request->asset_type_name,
                'status' => 1,
            ]);
            $notification = ([
                'success' => 'Asset Type Saved Successfully',
            ]);
        }

        return redirect()->back()->with($notification);
    }

    //delete asset
    function deleteAssetType($type_id)
    {
        AssetType::findOrFail($type_id)->update(['status' => 0]);
        return redirect()->back();
    }

    //index asset
    function indexAsset()
    {
        if (user(Auth::id()) == 1) {
            $assets = Asset::with('assetType')
                ->where(['status' => 1, 'type' => 'Local'])
                ->orderBy('id', 'desc')
                ->paginate(10);
        } elseif (user(Auth::id()) == 2) {
            $assets = Asset::with('assetType')
                ->where(['status' => 1, 'type' => 'Global'])
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $assets = Asset::with('assetType')
                ->where('status', 1)
                ->orderBy('id', 'desc')
                ->paginate(10);
        }

        return view('backend.theme.clasic.accounts.asset.assetIndex', compact('assets'));
    }
    //insert asset
    function addAsset()
    {
        $assetTypes = AssetType::where('status', 1)->get();
        return view('backend.theme.clasic.accounts.asset.insetAsset', compact('assetTypes'));
    }

    // inset and update asset type
    function insertAndUpdateAsset(Request $request)
    {
        $request->validate([
            'asset_type_id' => 'required',
            'asset_name' => 'required',
            'date' => 'required|date',
            'quantity' => 'required',
            'unit_price' => 'required',
            'total_price' => 'required',
            'type' => 'required',
            'remark' => 'required',
        ], [

            'asset_type_id.required' => 'Please Enter This Filed!',
            'asset_name.required' => 'Please Enter This Filed!',
            'date.required' => 'Please Enter This Filed!',
            'quantity.required' => 'Please Enter This Filed!',
            'unit_price.required' => 'Please Enter This Filed!',
            'total_price.required' => 'Please Enter This Filed!',
            'type.required' => 'Please Enter This Filed!',
            'remark.required' => 'Please Enter This Filed!',
        ]);
        if ($request->id) {
            Asset::findOrFail($request->id)->update([
                'asset_type_id' => $request->asset_type_id,
                'type' => $request->type,
                'asset_name' => $request->asset_name,
                'date' => $request->date,
                'quantity' => $request->quantity,
                'unit_price' => $request->unit_price,
                'total_price' => $request->total_price,
                'remark' => $request->remark,
            ]);
            $notification = ([
                'success' => 'Asset Updated Successfully',
            ]);
        } else {
            Asset::create([
                'asset_type_id' => $request->asset_type_id,
                'type' => $request->type,
                'asset_name' => $request->asset_name,
                'date' => $request->date,
                'quantity' => $request->quantity,
                'unit_price' => $request->unit_price,
                'total_price' => $request->total_price,
                'remark' => $request->remark,
            ]);
            $notification = ([
                'success' => 'Asset Saved Successfully',
            ]);
        }

        return redirect()->route('assets_list')->with($notification);
    }

    //edit asset
    function editAsset($asset_id)
    {
        $assetTypes = AssetType::where('status', 1)->get();
        $assetData = Asset::findOrFail($asset_id);
        return view('backend.theme.clasic.accounts.asset.editAsset', compact('assetData', 'assetTypes'));
    }

    // delete asset
    function deleteAsset($asset_id)
    {
        $assetData = Asset::findOrFail($asset_id)->update(['status' => 0]);
        return redirect()->back();
    }

    //*************************************************** asset end ******************************************************


    //*************************************************** loan start ******************************************************


    // index loan
    function indexLoan()
    {
        $loans = Loan::where("status", 1)->orderBy("id", 'desc')->paginate(10);
        return view('backend.theme.clasic.accounts.loan.loanIndex', compact('loans'));
    }

    // add loan page
    function addLoan()
    {
        return view('backend.theme.clasic.accounts.loan.addLoan');
    }

    // insert and update loan
    function insertAndUpdateLoan(Request $request)
    {
        $request->validate([
            'loan_type' => 'required',
            'date' => 'required|date',
            'finalcial_institute' => 'required|string|max:255',
            'loan_holder_name' => 'required|string|max:255',
            'loan_amount' => 'required|numeric',
            'remark' => 'required|max:500',
        ], [
            'loan_type' => 'Please Enter This Filed!',
            'date' => 'Please Enter This Filed!',
            'finalcial_institute' => 'Please Enter This Filed!',
            'loan_holder_name' => 'Please Enter This Filed!',
            'loan_amount' => 'Please Enter This Filed!',
            'remark' => 'Please Enter This Filed!',
        ]);
        if ($request->id) {
            Loan::findOrFail($request->id)->update([
                'loan_type' => $request->loan_type,
                'date' => $request->date,
                'finalcial_institute' => $request->finalcial_institute,
                'loan_holder_name' => $request->loan_holder_name,
                'loan_amount' => $request->loan_amount,
                'remark' => $request->remark,
            ]);
            $notification = ([
                'success' => 'Loan Updated Successfully',
            ]);
        } else {
            Loan::create([
                'loan_type' => $request->loan_type,
                'date' => $request->date,
                'finalcial_institute' => $request->finalcial_institute,
                'loan_holder_name' => $request->loan_holder_name,
                'loan_amount' => $request->loan_amount,
                'remark' => $request->remark,
            ]);
            $notification = ([
                'success' => 'Loan Saved Successfully',
            ]);
        }

        return redirect()->route('loans-list')->with($notification);
    }

    //edit loan
    function editLoan($loan_id)
    {
        $loanData = Loan::findOrFail($loan_id);
        return view('backend.theme.clasic.accounts.loan.editLoan', compact('loanData'));
    }
    //delete loan
    function deleteLoan($loan_id)
    {
        Loan::findOrFail($loan_id)->update(['status' => 0]);
        return redirect()->back();
    }




    //*************************************************** loan end ******************************************************



}
