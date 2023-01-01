<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aboutus;
use App\Models\multipic;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
class AboutController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function HomeAbout(){
        $about =Aboutus::latest()->get();
        return view('admin.about.index',compact('about'));
    }
    public function AddAbout(Request $request){
        Aboutus::insert([
            'title'=>$request->title,
            'short_description'=>$request->sdescription,
            'long_description'=>$request->ldescription,
            'created_at'=>Carbon::now(),
        ]);
        return Redirect()->back()->with('success','About Inserted Successful');
    }
    public function Edit($id){
        $about =Aboutus::find($id);
        return view('admin.about.edit',compact('about'));

    }
    public function Update(Request $request,$id){
    
       
        Aboutus::find($id)->update([
            'title'=>$request->title,
            'short_description'=>$request->sdescription,
            'long_description'=>$request->ldescription,
            
            "created_at"=>Carbon::now()
        ]);
    
        return Redirect()->route('Home.About')->with('success','About Updated Successfully');
       
    }

    public function Delete($id){
      
       Aboutus::find($id)->delete();
       return Redirect()->back()->with('success','About Deleted Successful');
    }
    
    // Portfolio page 
    public function Portfolio(){
     $images = multipic::all();  
     return view('pages.portfolio',compact('images'));
    }











}
