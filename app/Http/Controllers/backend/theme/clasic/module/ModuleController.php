<?php

namespace  App\Http\Controllers\backend\theme\clasic\module;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Module;
use Carbon\Carbon;

class ModuleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // user type create
// ********************************************* module  start**************************************************
    function index(){
        $modules = Module::orderBy('id', 'ASC')->where('status', 1)->get();
        return view('backend.theme.clasic.module.insert_module',['modules' => $modules]);
    }

    // store user type

    function store(Request $request){
        $request->validate([
            'title' => 'required',
        ],[
            'title.required' => 'Please Enter This Field!'
        ]);

        Module::insert([
            'title' => $request->title,
            'parents' => 0,
            'orgine' => 0,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->back()->with('message', 'Module Stored Successfully.');

    }

    //user type edit

    function edit($id){
        $modules = Module::latest()->where('status', 1)->get();
        $moduleData =  Module::findOrFail($id);
        $parent_modules = Module::where("orgine", 0)->where("status", 1)->get();
        if($moduleData->parents == 0 && $moduleData->orgine == 0){
             return view('backend.theme.clasic.module.edit_module',[
                'moduleData' => $moduleData,
                'modules' => $modules
           ]);
        } else if($moduleData->parents == $moduleData->orgine &&  $moduleData->parents != 0){
            return view('backend.theme.clasic.module.edit_sub_module',[
               'moduleData' => $moduleData,
               'modules' => $modules,
               'parent_modules' => $parent_modules
          ]);
        } else{
            return view('backend.theme.clasic.module.edit_sub_sub_module',[
               'moduleData' => $moduleData,
               'modules' => $modules,
               'parent_modules' => $parent_modules
          ]);
        }

    }

    // user type update

    function update(Request $request){

        $request->validate([
            'title' => 'required',
        ],[
            'title.required' => 'Please Enter This Field!'
        ]);
        $module_id =  $request->id;
        Module::findOrFail($module_id)->update([
            'title' => $request->title,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('module')->with('message', 'Module Updated Successfully.');
    }

    //delete user type

    function delete($id){
        Module::findOrFail($id)->update(['status'=> 0]);
        return redirect()->back()->with('danger', 'Module Deleted Successfully.');
    }
// ********************************************* module  end**************************************************


// ********************************************* sub module  start**************************************************

    //create sub module

    function create_sub_module(){

        $modules = Module::latest()->where('status', 1)->get();
        $parent_modules = Module::where("orgine", 0)->where("status", 1)->get();
        return view('backend.theme.clasic.module.insert_sub_module', compact('modules','parent_modules'));
    }

    //store sub module

    function store_update_sub_module(Request $request){
        $request->validate([
            'title' => 'required',
            'parents' => 'required',
        ],[
            'title.required' => 'Please Enter This Field!',
            'parents.required' => 'Please Select the Parent',
        ]);
        $module_id = $request->id;
        if ($module_id) {

            Module::findOrFail($module_id)->update([
                'title' => $request->title,
                'parents' => $request->parents,
                'orgine' => $request->parents,
                'updated_at' => Carbon::now(),
            ]);
            return redirect()->route('module')->with('message', 'Sub Module Updated Successfully.');
        } else {

            Module::insert([
                'title' => $request->title,
                'parents' => $request->parents,
                'orgine' => $request->parents,
                'created_at' => Carbon::now(),
            ]);
            return redirect()->route('module')->with('message', 'Sub Module Stored Successfully.');
        }

    }
// ********************************************* sub module  end**************************************************


// ********************************************* sub sub module  start**************************************************

    // sub sub module

    function create_sub_sub_module(){
        $modules = Module::latest()->where('status', 1)->get();
        $parent_modules = Module::where("orgine", 0)->where("status", 1)->get();
        return view('backend.theme.clasic.module.insert_sub_sub_module', compact('modules','parent_modules'));
    }

    function subModuleAjax($parent_id){

        $modules = Module::where('parents', $parent_id)->get();
        return response()->json($modules);
    }

    function store_update_sub_sub_module(Request $request){

        $request->validate([
            'title' => 'required',
            'parents' => 'required',
            'orgine' => 'required',
        ],[
            'title.required' => 'Please Enter This Field!',
            'parents.required' => 'Please Select the Parent',
            'orgine.required' => 'Please Select the Parent',
        ]);
        $module_id = $request->id;

        if ($module_id) {
            Module::findOrFail($module_id)->update([
                'title' => $request->title,
                'parents' => $request->parents,
                'orgine' => $request->orgine,
                'updated_at' => Carbon::now(),
            ]);
            return redirect()->route('module')->with('message', 'Sub Sub Module Updated Successfully.');
        } else {
            Module::insert([
                'title' => $request->title,
                'parents' => $request->parents,
                'orgine' => $request->orgine,
                'created_at' => Carbon::now(),
            ]);
            return redirect()->route('module')->with('message', 'Sub Sub Module Stored Successfully.');
        }


    }

// ********************************************* sub sub module end**************************************************

}