<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactForm;


class ContactController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function HomeContact(){
        $contact =Contact::latest()->get();
        return view('admin.pages.contact',compact('contact'));
    }
    public function AddContact(Request $request){
        Contact::insert([
            'address'=>$request->address,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'created_at'=>Carbon::now(),
        ]);
        return Redirect()->back()->with('success','contact Inserted Successful');
    }
    public function Edit($id){
        $contact =Contact::find($id);
        return view('admin.pages.edit_contact',compact('contact'));

    }
    public function Update(Request $request,$id){
    
       
        Contact::find($id)->update([
            'address'=>$request->address,
            'email'=>$request->email,
            'phone'=>$request->phone,
            
            "created_at"=>Carbon::now()
        ]);
    
        return Redirect()->route('Home.Contact')->with('success','contact Updated Successfully');
       
    }

    public function Delete($id){
      
       Contact::find($id)->delete();
       return Redirect()->back()->with('success','contact Deleted Successful');
    }

    //page out contact
    public function PageContact(){
        $contact =Contact::all();
        return view('pages.contact',compact('contact'));
    }
    ////add message
    public function AddMessage(Request $request){
        ContactForm::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'message'=>$request->message,
            'created_at'=>Carbon::now(),
        ]);
        return Redirect()->back()->with('success','Sent Message Successful');
    }
    public function ContactMessage(){
        $messages =ContactForm::latest()->paginate(5);
        return view('admin.pages.message',compact('messages'));
    }
    public function DeleteMessage($id){
       ContactForm::find($id)->delete();
       return Redirect()->back()->with('success','Deleted Message');
    }
}
