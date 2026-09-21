<?php

namespace App\Http\Controllers\backend\theme\clasic\about_us;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\AboutBanner;
use App\model\AboutHistory;
use App\model\AboutUs;
use App\model\AssignStack;
use App\model\SingleAboutCardDetails;
use App\model\Stack;
use App\ProjectCompletedByEmployee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AboutUsController extends Controller
{
    // ************************************************* hr card start********************************************
    function indexAbout()
    {
        $abouts = AboutUs::latest()
            ->where('status', 1)
            ->paginate(10);
        return view('backend.theme.clasic.about.whoWeAre.whoWeAreList', compact('abouts'));
    }

    //create about
    function createAbout()
    {
        return view('backend.theme.clasic.about.whoWeAre.create_whoWeAre');
    }

    //store about who we are

    function storeAbout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'designation' => 'required',
            'image_alt' => 'required',
            'type' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = [
                'error' => 'Something is wrong. Please Fill all the fill carefully',
            ];

            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with($notification);
        }

        if ($request->type == 'chairman') {
            $image = $request->file('image');
            $name_gen = $image->getClientOriginalName();
            Image::make($image)
                ->resize(350, 405)
                ->save('public/uploads/who_we_are/images/' . $name_gen);
            $save_url = 'public/uploads/who_we_are/images/' . $name_gen;
        } else {
            $image = $request->file('image');
            $name_gen = $image->getClientOriginalName();
            Image::make($image)
                ->resize(255, 220)
                ->save('public/uploads/who_we_are/images/' . $name_gen);
            $save_url = 'public/uploads/who_we_are/images/' . $name_gen;
        }

        $slug = strtolower($request->name);
        $slug = preg_replace('/[^a-z0-9]+/', '_', $slug);
        $slug = trim($slug, '_');


        AboutUs::insert([
            'name' => $request->name,
            'slug' => $slug,
            'designation' => $request->designation,
            'image_alt' => $request->image_alt,
            'type' => $request->type,
            'image' => $save_url,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);
        $notification = [
            'success' => 'Added About Hr Successfully',
        ];
        return redirect()
            ->route('who-we-are-list')
            ->with($notification);
    }

    //edit who we are

    function editAbout($about_id)
    {
        $about = AboutUs::findOrFail($about_id);
        return view('backend.theme.clasic.about.whoWeAre.edit_whoWeAre', compact('about'));
    }

    // update who we are
    function updateAbout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'designation' => 'required',
            'image_alt' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = [
                'error' => 'Something is wrong. Please Fill all the fill carefully',
            ];

            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with($notification);
        }

        $about_id = $request->id;
        $about = AboutUs::findOrFail($about_id);
        $save_url = $about->image;

        if ($request->type == 'chairman') {
            if ($request->file('image')) {
                $old_img = $request->old_img;
                File::delete($old_img);
                $image = $request->file('image');
                $name_gen = $image->getClientOriginalName();
                Image::make($image)
                    ->resize(350, 405)
                    ->save('public/uploads/who_we_are/images/' . $name_gen);
                $save_url = 'public/uploads/who_we_are/images/' . $name_gen;
            }
        } else {
            if ($request->file('image')) {
                $old_img = $request->old_img;
                File::delete($old_img);
                $image = $request->file('image');
                $name_gen = $image->getClientOriginalName();
                Image::make($image)
                    ->resize(255, 220)
                    ->save('public/uploads/who_we_are/images/' . $name_gen);
                $save_url = 'public/uploads/who_we_are/images/' . $name_gen;
            }
        }

        $slug = strtolower($request->name);
        $slug = preg_replace('/[^a-z0-9]+/', '_', $slug);
        $slug = trim($slug, '_');



        AboutUs::findOrFail($about_id)->update([
            'name' => $request->name,
            'slug' => $slug,
            'designation' => $request->designation,
            'image' => $save_url,
            'image_alt' => $request->image_alt,
            'type' => $request->type,
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);
        $notification = [
            'success' => 'Updated Who We Are Successfully',
        ];
        return redirect()
            ->route('who-we-are-list')
            ->with($notification);
    }

    //about delete

    function deleteAbout($about_id)
    {
        AboutUs::findOrFail($about_id)->update(['status' => 0]);
        return redirect()->back();
    }

    //inactive about

    function aboutInactive($about_id)
    {
        $slider = AboutUs::findOrFail($about_id)->update([
            'active_who' => 0,
        ]);
        return redirect()->back();
    }

    //active about

    function aboutActive($about_id)
    {
        $slider = AboutUs::findOrFail($about_id)->update([
            'active_who' => 1,
        ]);
        return redirect()->back();
    }

    function aboutEmployee($about_id)
    {
        $slider = AboutUs::findOrFail($about_id)->update([
            'is_intern' => 0,
        ]);
        return redirect()->back();
    }

    //active about

    function aboutIntern($about_id)
    {
        $slider = AboutUs::findOrFail($about_id)->update([
            'is_intern' => 1,
        ]);
        return redirect()->back();
    }

    function whoWeAreList($about_id)
    {
        $about = AboutUs::with('singleAboutDetail','assign_stacks')->findOrFail($about_id);
        $abouts = AboutUs::orderBy('name', 'asc')->get();
        $stack_lists = Stack::orderBy('name', 'asc')->paginate(5);
        $stacks = Stack::orderBy('name', 'asc')->get();
        return view('backend.theme.clasic.about.whoWeAre.single_about_card', compact('about','abouts','stacks','stack_lists'));
    }

    function storeAboutInfo(Request $request)
    {
        $rules = ['about_card_id' => 'required|integer', 'employee_type' => 'required|string|max:20', 'joining_date' => 'required|date', 'end_date' => 'date|nullable', 'description => "string|max:1000'];

        $currently_working_status = $request->currently_working_status == null ? 0 : 1;

        if ($currently_working_status == null) {
            $rules['end_date'] = 'required|date';
        }

        Validator::make($request->all(), $rules)->validate();
        $ending_date = $request->end_date == null ? null : Carbon::parse($request->end_date);
        $currently_working_status = $request->currently_working_status == null ? 0 : 1;
        if ($ending_date == null) {
            $currently_working_status = 1;
        } elseif ($request->currently_working_status == 1) {
            $ending_date = null;
        }

        $aboutSingleCard = SingleAboutCardDetails::where('about_card_id', $request->about_card_id)->first();
        if (!$aboutSingleCard) {
            $aboutSingleCard = new SingleAboutCardDetails();
        }

        $aboutSingleCard->about_card_id = $request->about_card_id;
        $aboutSingleCard->description = $request->description;
        $aboutSingleCard->employee_type = $request->employee_type;
        $aboutSingleCard->joining_date = Carbon::parse($request->joining_date);
        $aboutSingleCard->currently_working_status = $currently_working_status;
        $aboutSingleCard->end_date = $ending_date;
        $aboutSingleCard->save();

        if ($aboutSingleCard) {
            $notification = [
                'success' => 'Info Saved Successfully',
            ];
            return response()->json($notification);
        }
    }

    //store stack

    public function assignStack(Request $request)
    {
        $rules = ['stack_id.*' => 'required|integer', 'about_id' => 'required|integer'];
        $messages = ['stack_id' => 'Please Select A Stack', 'about_id' => 'Please Select A Name'];
        Validator::make($request->all(), $rules, $messages)->validate();

        $count = count($request->stack_id);
        for ($i=0; $i < $count; $i++) { 
            $stack = new AssignStack();
            $stack->about_id = $request->about_id;
            $stack->stack_id = $request->stack_id[$i];
            $stack->created_by = Auth::id();
            $stack->save();
        }

        if ($stack) {
            $notification = [
                'success' => 'Stack Assigned Successfully',
            ];
            return response()->json($notification);
        }
    }

    //delete assign stact

    public function deleteAssignAsset($stack_id)
    {
        AssignStack::findOrFail($stack_id)->delete();
        return redirect()->back();
    }

    //store stack

    public function storeStack(Request $request)
    {
        $rules = ['logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 'name' => 'required|string|max:20'];
        Validator::make($request->all(), $rules)->validate();

        $image = $request->logo;
        if ($request->file('logo')) {
            $image = uploadPlease($request->file('logo'));
        }

        $stack = new Stack();
        $stack->name = $request->name;
        $stack->logo = $image;
        $stack->save();

        if ($stack) {
            $notification = [
                'success' => 'Stack Saved Successfully',
            ];
            return response()->json($notification);
        }
    }

    //store stack
    public function updateStack(Request $request)
    {
        $rules = ['logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 'name' => 'required|string|max:20'];
        Validator::make($request->all(), $rules)->validate();

        $stack = Stack::findOrFail($request->id);

        $image = $stack->logo;
        if ($request->file('logo')) {
            File::delete($image);
            $image = uploadPlease($request->file('logo'));
        }

        $stack->name = $request->name;
        $stack->logo = $image;
        $stack->save();

        if ($stack) {
            $notification = [
                'success' => 'Stack Updated Successfully',
            ];
            return response()->json($notification);
        }
    }

    //store project

    public function storeProjectForEmployee(Request $request)
    {
        $rules = [
            'about_card_id' => 'required|numeric',
            'project_title' => 'required|string|max:100',
            'short_description' => 'required|string|max:500',
            'start_date' => 'required|date',
        ];

        Validator::make($request->all(), $rules)->validate();

        
        $currently_working_status = $request->currently_working_status == null ? 0 : 1;
        
        if ($currently_working_status == null) {
            $rules['end_date'] = 'required|date';
        }

        Validator::make($request->all(), $rules)->validate();
        $ending_date = $request->end_date == null ? null : Carbon::parse($request->end_date);
        $currently_working_status = $request->currently_working_status == null ? 0 : 1;
        if ($ending_date == null) {
            $currently_working_status = 1;
        } elseif ($request->currently_working_status == 1) {
            $ending_date = null;
        }

        $project = new ProjectCompletedByEmployee();

        $project->about_card_id = $request->about_card_id;
        $project->project_title = $request->project_title;
        $project->short_description = $request->short_description;
        $project->start_date = $request->start_date;
        $project->end_date = $ending_date;
        $project->currently_working_status = $currently_working_status;
        $project->save();

        if ($project) {
            $notification = [
                'success' => 'Project Saved Successfully',
            ];
            return response()->json($notification);
        }
    }

    public function updateProjectForEmployee(Request $request)
    {
        
        $rules = [
            'about_card_id' => 'required|numeric',
            'project_title' => 'required|string|max:100',
            'short_description' => 'required|string|max:500',
            'start_date' => 'required|date',
        ];

        Validator::make($request->all(), $rules)->validate();

        
        $currently_working_status = $request->currently_working_status == null ? 0 : 1;

        if ($currently_working_status == null) {
            $rules['end_date'] = 'required|date';
        }

        Validator::make($request->all(), $rules)->validate();
        $ending_date = $request->end_date == null ? null : Carbon::parse($request->end_date);
        $currently_working_status = $request->currently_working_status == null ? 0 : 1;
        if ($ending_date == null) {
            $currently_working_status = 1;
        } elseif ($request->currently_working_status == 1) {
            $ending_date = null;
        }

        $project = ProjectCompletedByEmployee::findOrFail($request->id);

        $project->about_card_id = $request->about_card_id;
        $project->project_title = $request->project_title;
        $project->short_description = $request->short_description;
        $project->start_date = $request->start_date;
        $project->end_date = $ending_date;
        $project->currently_working_status = $currently_working_status;
        $project->save();

        if ($project) {
            $notification = [
                'success' => 'Project Updated Successfully',
            ];
            return response()->json($notification);
        }
    }

    // ************************************************* hr card end********************************************

    // ************************************************* history start********************************************
    function indexHistory()
    {
        $histories = AboutHistory::orderBy('id', 'desc')
            ->where('status', 1)
            ->paginate(10);
        return view('backend.theme.clasic.about.history.history_index', compact('histories'));
    }

    function historyStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'image_alt' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = [
                'error' => 'Something is wrong. Please Fill all the fill carefully',
            ];

            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with($notification);
        }
        $image = $request->file('image');
        $name_gen = $image->getClientOriginalName();
        Image::make($image)
            ->resize(540, 400)
            ->save('public/uploads/who_we_are/history/' . $name_gen);
        $save_url = 'public/uploads/who_we_are/history/' . $name_gen;

        AboutHistory::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $save_url,
            'image_alt' => $request->image_alt,
        ]);
        $notification = [
            'success' => 'Added About Page History',
        ];
        return redirect()
            ->back()
            ->with($notification);
    }

    function historyUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'image_alt' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = [
                'error' => 'Something is wrong. Please Fill all the fill carefully',
            ];

            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with($notification);
        }

        $history = AboutHistory::findOrFail($request->id);
        $save_url = $history->image;
        if ($request->file('image')) {
            $old_img = $request->old_img;
            File::delete($old_img);
            $image = $request->file('image');
            $name_gen = $image->getClientOriginalName();
            Image::make($image)
                ->resize(540, 400)
                ->save('public/uploads/who_we_are/history/' . $name_gen);
            $save_url = 'public/uploads/who_we_are/history/' . $name_gen;
        }

        $update = $history->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $save_url,
            'image_alt' => $request->image_alt,
        ]);

        if ($update == true) {
            $notification = [
                'success' => 'Updated About Page History',
            ];
            return redirect()
                ->back()
                ->with($notification);
        } else {
            $notification = [
                'error' => 'Updated Failed',
            ];
            return redirect()
                ->back()
                ->with($notification);
        }
    }

    function inactiveHistory($history_id)
    {
        AboutHistory::findOrFail($history_id)->update(['active_status' => 0]);
        return redirect()->back();
    }
    function activeHistory($history_id)
    {
        $history_row = AboutHistory::findOrFail($history_id);
        $histories = AboutHistory::where('status', 1)
            ->where('active_status', 1)
            ->get();
        foreach ($histories as $history) {
            AboutHistory::where('id', $history->id)->update(['active_status' => 0]);
        }
        $history_row->update(['active_status' => 1]);
        return redirect()->back();
    }
    function deleteHistory($history_id)
    {
        AboutHistory::findOrFail($history_id)->update(['status' => 0]);
        return redirect()->back();
    }

    // ************************************************* history end********************************************

    // ************************************************* banner start********************************************

    function about_banner()
    {
        $banners = AboutBanner::orderBy('id', 'desc')
            ->where('status', 1)
            ->paginate(10);
        return view('backend.theme.clasic.about.banner.index_bannder', compact('banners'));
    }

    function banner_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'image_alt' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = [
                'error' => 'Something is wrong. Please Fill all the fill carefully',
            ];

            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with($notification);
        }
        $image = $request->file('image');
        $name_gen = $image->getClientOriginalName();
        Image::make($image)
            ->resize(1350, 390)
            ->save('public/uploads/who_we_are/banner/' . $name_gen);
        $save_url = 'public/uploads/who_we_are/banner/' . $name_gen;
        AboutBanner::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $save_url,
            'image_alt' => $request->image_alt,
        ]);
        $notification = [
            'success' => 'Added About Page Banner',
        ];
        return redirect()
            ->back()
            ->with($notification);
    }

    function banner_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'image_alt' => 'required',
        ]);

        if ($validator->fails()) {
            $notification = [
                'error' => 'Something is wrong. Please Fill all the fill carefully',
            ];

            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with($notification);
        }

        $banner = AboutBanner::findOrFail($request->id);
        $save_url = $banner->image;
        if ($request->file('image')) {
            $old_img = $request->old_img;
            File::delete($old_img);
            $image = $request->file('image');
            $name_gen = $image->getClientOriginalName();
            Image::make($image)
                ->resize(1350, 390)
                ->save('public/uploads/who_we_are/banner/' . $name_gen);
            $save_url = 'public/uploads/who_we_are/banner/' . $name_gen;
        }

        AboutBanner::findOrFail($request->id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $save_url,
            'image_alt' => $request->image_alt,
        ]);
        $notification = [
            'success' => 'Updated About Page Banner',
        ];
        return redirect()
            ->back()
            ->with($notification);
    }

    function inactiveBanner($banner_id)
    {
        AboutBanner::findOrFail($banner_id)->update(['active_status' => 0]);
        return redirect()->back();
    }
    function activeBanner($banner_id)
    {
        $history_row = AboutBanner::findOrFail($banner_id);
        $histories = AboutBanner::where('status', 1)
            ->where('active_status', 1)
            ->get();
        foreach ($histories as $history) {
            AboutBanner::where('id', $history->id)->update(['active_status' => 0]);
        }
        $history_row->update(['active_status' => 1]);
        return redirect()->back();
    }
    function deleteBanner($banner_id)
    {
        AboutBanner::findOrFail($banner_id)->update(['status' => 0]);
        return redirect()->back();
    }
    // ************************************************* banner end********************************************
}
