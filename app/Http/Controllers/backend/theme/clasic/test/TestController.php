<?php

namespace App\Http\Controllers\backend\theme\clasic\test;

use App\Exports\TestUserExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Student;
use App\testModel\SortingTest;
use Illuminate\Support\Facades\DB;
use App\Imports\TestUserImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
class TestController extends Controller
{

    function test()
    {

        //1. Retrieving A Single Row / Column From A Table

        // $user = DB::table('students')->where('student_name', 'Ariful sikder')->value('email');

        // echo $user;



        //2. Retrieving A List Of Column Values

        // $titles = DB::table('students')->pluck('student_name', 'email');
        // echo  $titles->count(); //like group by
        // echo "<br>";
        // foreach ($titles as  $name => $names) {
        //     echo  $name;
        //     echo "<br>";
        // }

        //3. Chunking Results

        // DB::table('students')->orderBy('id')->chunk(1, function ($users) {
        //     foreach ($users as $user) {
        //         dd($user);
        //         // echo $user;
        //         // echo "<br>";
        //     }
        // });

        // DB::table('students')->orderBy('id')->chunk(2, function ($users) {
        //     // Process the records...

        //     dd($users);
        //     return false;
        // });

        //4. Chunking Results By Primary Key


        // DB::table("students")->where('status', 1)->chunkById(2, function ($students) {
        //     foreach ($students as $student) {
        //         dd($student);
        //         $st = DB::table("students")->where('id', $student->id)->get();
        //         dd($st);
        //     }
        // });

        return view('backend.theme.clasic.testing.test');
    }


    function sortingdata(){
        $testData = SortingTest::orderBy('order','ASC')->get();
        return view('backend.theme.clasic.testing.sorting_test', compact('testData'));
    }

    function text_sorting(Request $request){
        $sortData = SortingTest::all();
        foreach ($sortData as $sort) {
            foreach ($request->order as $order) {
                if ($order['id'] == $sort->id) {
                    $sort->update(['order' => $order['position']]);
                }
            }
        }
        return response('Update Successfully.', 200);
    }

    // for excel tesing
    function excel(){
        return view('backend.theme.clasic.testing.testing_excel');
    }

    public function export()
    {
        return Excel::download(new TestUserExport, 'users.xlsx');
    }


    public function import(Request $request)
    {
        $request->validate([
            'file_excel' => 'required',
        ],[
            'file_excel.required' => 'Please Upload Your Excel File!'
        ]);

       Excel::import(new TestUserImport, $request->file('file_excel'));

        $notification = ([
            'success' => 'Imported Successfully',
        ]);
        return redirect()->back()->with($notification);
    }

    
    function freeTemplete(){
        
        return response()->download(public_path('xlxs/demo.xlsx'));
    }

}