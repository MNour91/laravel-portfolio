<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\slider;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManagerStatic as Image;


class SliderController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function AllSlider(){
        $sliders =slider::latest()->paginate(5);
        return view('admin.slider.index',compact('sliders'));
    }
    public function AddSlider(Request $request){
        $validated = $request->validate([
            'title' => 'required|unique:sliders|min:10',
            'description' => 'required|unique:sliders|min:30',
            'image' => 'required|mimes:jpg,jpeg,gif,png',


        ],
        [
            'title.required' => 'Please Enter Slider Title',
            'title.min' => 'Brand Name longer Than 10 Chars',
            'description.required' => 'Please Enter Slider Description',
            'description.min' => 'Brand Name longer Than 30 Chars',
            'image.required' => 'Please Enter Slider Image',
        ]);
        $slider_img = $request->file('image');
        $name_gen = hexdec(uniqid()).$slider_img->getClientOriginalExtension();
         Image::make($slider_img)->resize(1920,1088)->save('image/slider/'.$name_gen);
         $last_img = 'image/slider/'.$name_gen;
         slider::insert([
        'title'=>$request->title,
        'description'=>$request->description,
        "image"=>$last_img,
        "created_at"=>Carbon::now()
        ]);
        return Redirect()->back()->with('success','Slider Inserted Successful');
    }
    public function Edit($id){
        $sliders =slider::find($id);
        return view('admin.slider.edit',compact('sliders'));

    }
    public function Update(Request $request,$id){
        $validated = $request->validate([
            'title' => 'required|unique:sliders|min:10',
            'description' => 'required|unique:sliders|min:30',
            'image' => 'required|mimes:jpg,jpeg,gif,png',


        ],
        [
            'title.required' => 'Please Enter Slider Title',
            'title.min' => 'Brand Name longer Than 10 Chars',
            'description.required' => 'Please Enter Slider Description',
            'description.min' => 'Brand Name longer Than 30 Chars',
            'image.required' => 'Please Enter Slider Image',
        ]);
        $old_img = $request->old_img;
        $image = $request->file('image');
        if($image){
            // $name_gen = hexdec(uniqid());
            // $img_ext = strtolower($image->getClientOriginalExtension());
           
            // $new_img_name = $name_gen.".".$img_ext;
            // $up_location = 'image/slider/';
            // $last_img =$up_location.$new_img_name;
          
            // $image->move($up_location,$new_img_name);
            $name_gen = hexdec(uniqid()).$image->getClientOriginalExtension();
            Image::make($image)->resize(1920,1088)->save('image/slider/'.$name_gen);
            $last_img = 'image/slider/'.$name_gen;
            unlink($old_img);
            slider::find($id)->update([
                'title'=>$request->title,
                'description'=>$request->description,
                "image"=>$last_img,
                "created_at"=>Carbon::now()
            ]);
        
            return Redirect()->route('All.Slider')->with('success','Slider Updated Successfully');
        }else{
            slider::find($id)->update([
                'title'=>$request->title,
                'description'=>$request->description,
                "created_at"=>Carbon::now()
            ]);

            return Redirect()->route('All.Slider')->with('success','Slider Updated Successfully');
        }   
    }

    public function Delete($id){
       $slider= slider::find($id);
       $img = $slider->image;
       unlink($img);
       slider::find($id)->delete();
       return Redirect()->back()->with('success','Slider Deleted Successful');
    }


}
