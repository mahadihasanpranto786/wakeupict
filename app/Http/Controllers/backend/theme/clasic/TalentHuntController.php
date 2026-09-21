<?php

namespace App\Http\Controllers\backend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\TalentHunt;
use Illuminate\Support\Facades\Auth;

class TalentHuntController extends Controller
{
    public function index()
    {
        $data['post'] = TalentHunt::orderBy('id', 'asc')->first();
        return view('backend.theme.clasic.talent_hunt.index_backend', $data);
    }

    public function create()
    {
        $data['post'] = TalentHunt::orderBy('id', 'asc')->first();
        return view('backend.theme.clasic.talent_hunt.create_talent', $data);
    }

    public function storeTalent(Request $request)
    {
        $request->validate([
            'description' => 'string',
        ]);

        $post = TalentHunt::latest()->first();

        if (!isset($post)) {
            $post = new TalentHunt();
        }

        $post->description = $request->description;
        $post->title = $request->title;
        $post->created_by = Auth::id();

        $post->save();

        $notification = [
            'success' => 'Saved Successfully',
        ];

        return redirect()->back()->with($notification);
    }

    public function inactive()
    {
        TalentHunt::latest()->first()->update(['status' => 0]);
        return redirect()->back();
    }
    public function active()
    {
        TalentHunt::latest()->first()->update(['status' => 1]);
        return redirect()->back();
    }
    public function delete()
    {
        TalentHunt::latest()->first()->delete();
        return redirect()->back();
    }
}
