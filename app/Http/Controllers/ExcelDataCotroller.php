<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\ExcelData;
use App\model\ExcelName;
use App\Exports\ExcelDataExport;
use App\Imports\ExcelDataImport;
use Maatwebsite\Excel\Facades\Excel;
class ExcelDataCotroller extends Controller
{
    // for excel tesing
    function excel(){
        $excel_names = ExcelName::latest()->get();
        return view('backend.theme.clasic.testing.data-excel', compact('excel_names'));
    }

    public function import(Request $request)
    {
    $request->validate([
        'file_excel' => 'required',
    ],[
        'file_excel.required' => 'Please Upload Your Excel File!'
    ]);

    Excel::import(new ExcelDataImport, $request->file('file_excel'));

    $notification = ([
        'success' => 'Imported Successfully',
    ]);
    return redirect()->back()->with($notification);
    }

    function export($id){

        return (new ExcelDataExport)->id($id)->download('something.xlsx');

    }


}