<?php

namespace App\Http\Controllers\backend\theme\clasic\contact_us;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\ContactUs;
use Carbon\Carbon;

class ContactUsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // contact list 

    function index()
    {
        $contacts = ContactUs::latest()->get();
        return view('backend.theme.clasic.contact_us.contact_us_list', compact('contacts'));
    }

    //edit contact

    function editContact($contact_id)
    {
        $contact = ContactUs::findOrFail($contact_id);
        return view('backend.theme.clasic.contact_us.contact_us_edit', compact('contact'));
    }

    // update contact 

    function updateContact(Request $request)
    {
        $contact_id = $request->id;
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'message' => 'required',
            'image' => 'required',
        ], [
            'name.required' => 'This Field Is Requited!',
            'phone.required' => 'This Field Is Requited!',
            'email.required' => 'This Field Is Requited!',
            'message.required' => 'This Field Is Requited!',
            'image.required' => 'This Field Is Requited!',
        ]);

        ContactUs::findOrFail($contact_id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'website' => $request->website,
            'message' => $request->message,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);


        $notification = ([
            'success' => 'Contact Updated Successfully',
        ]);
        return redirect()->route('contact-list')->with($notification);
    }

    //delete contact 

    function deleteContact($contact_id)
    {
        ContactUs::findOrFail($contact_id)->delete();
        return redirect()->back();
    }


    // view contact 

    function viewContact($contact_id)
    {
        $contact =  ContactUs::findOrFail($contact_id);
        return view('backend.theme.clasic.contact_us.contact_view', compact('contact'));
    }
}
