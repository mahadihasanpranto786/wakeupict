<?php

namespace App\Http\Controllers\backend\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\AdmitedStudent;
use App\model\Blog;
use App\model\ContactUs;
use App\model\Course;
use App\model\Expense;
use App\model\ExpensePayback;
use App\model\Income;
use App\model\Page;
use App\model\Visitor;
use App\User;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index()
    {
        //one week data
        $now = new Carbon();
        $weeklyData = [];
        for ($i = 6; $i >= 0; $i--) {
            $items = Visitor::where('visit_time', 'LIKE',  '%' . $now->clone()->subDays($i)->format('Y-m-d') . '%')
                ->count();
            $weeklyData[$now->clone()->subDays($i)->format('l')] = $items;
        }

        $pages = Page::latest()->count();
        $courses = Course::latest()->count();
        $blogs = Blog::latest()->count();
        $course_member = User::latest()->count();
        $visitors = Visitor::latest()->count();
        $currentYear = Carbon::now()->format('Y');
        $currentMonth = Carbon::now()->format('m');
        $CurrentMonthVisitors = Visitor::where('status', 1)->whereYear('visit_time', '=', $currentYear)
            ->whereMonth('visit_time', '=', $currentMonth)->count();
        $admittedStudents = AdmitedStudent::latest()->count();
        $contacts = ContactUs::latest()->count();
        return view(
            'backend.theme.clasic.admin_layouts.index',
            compact(
                'pages',
                'courses',
                'blogs',
                'course_member',
                'visitors',
                'CurrentMonthVisitors',
                'admittedStudents',
                'contacts',
                'weeklyData'
            )
        );
    }

    public function incomeExpenseChart()
    {
        $now = new Carbon();
        $aYearAgo = $now->clone()->subYears(1);
        $monthlyExpense = [];
        $monthlyIncome = [];

        foreach ($this->getDateRange($aYearAgo, $now) as $date) {

            $monthActivity = Expense::where('status', 1)
                ->whereYear('date', '=', Carbon::parse($date)->format('Y'))
                ->whereMonth('date', '=', Carbon::parse($date)->format('m'))
                ->sum('amount') - ExpensePayback::select('payback_money')
                ->where('status', 1)
                ->whereYear('expense_date', '=', Carbon::parse($date)->format('Y'))
                ->whereMonth('expense_date', '=', Carbon::parse($date)->format('m'))
                ->sum('payback_money');


            $income = Income::where('status', 1)
                ->whereYear('date', '=', Carbon::parse($date)->format('Y'))
                ->whereMonth('date', '=', Carbon::parse($date)->format('m'))
                ->sum('amount');

            $monthlyIncome[$date->format('Y-m')] = $income;
            $monthlyExpense[$date->format('Y-m')] = $monthActivity;
        }

        return response()->json([
            'monthlyExpense' => $monthlyExpense,
            'monthlyIncome' => $monthlyIncome,
        ]);
    }


    private function getDateRange($from, $to)
    {
        return new DatePeriod($from, new DateInterval('P1M'), $to);
    }
}
