<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\multipic;

 
class BrandController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
   public function AllBrand(){
       $brands = Brand::latest()->paginate(5);
    //    $trachBrand = Brand:: onlyTrashed()->latest()->paginate(3);
    return view('admin.brand.index',compact('brands'));

   }
   public function AddBrand(Request $request){
    $validated = $request->validate([
        'brand_name' => 'required|unique:brands|min:4',
        'brand_img' => 'required|mimes:jpg,jpeg,gif,png',


    ],
    [
        'brand_name.required' => 'Please Enter Category Name',
        'brand_name.min' => 'Brand Name longer Than 4 Chars',

    ]);
    //img laravel
    $brand_img = $request->file('brand_img');

    // $name_gen = hexdec(uniqid());
    // $img_ext = strtolower($brand_img->getClientOriginalExtension());
    // $new_img_name = $name_gen.".".$img_ext;
    // $up_location = 'image/brand/';
    // $last_img =$up_location.$new_img_name;
    // $brand_img->move($up_location,$new_img_name);
    
    $name_gen = hexdec(uniqid()).$brand_img->getClientOriginalExtension();
    Image::make($brand_img)->resize(300,200)->save('image/brand/'.$name_gen);
    $last_img = 'image/brand/'.$name_gen;
    Brand::insert([
        'brand_name'=>$request->brand_name,
        "brand_img"=>$last_img,
        "created_at"=>Carbon::now()
    ]);

    $notification = array(
        'message'=>'Brand Inserted Successful',
        'alert-type'=>'success'
    );
    return Redirect()->back()->with($notification);
   }
   public function Edit($id){
    $brands = Brand::find($id);
    return view('admin.brand.edit',compact('brands'));
   }

   public function Update(Request $request , $id){
    $validated = $request->validate([
        'brand_name' => 'required|unique:brands|min:4',
        'brand_img' =>  'required|mimes:png,jpeg,gif,jpg',


    ],
    [
        'brand_name.required' => 'Please Enter Brand Name',
        'brand_name.min' => 'Brand Name longer Than 4 Chars',

    ]);
    //img laravel
    $old_img = $request->old_img;
    $brand_img = $request->file('brand_img');
    if($brand_img){
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_img->getClientOriginalExtension());
        $new_img_name = $name_gen.".".$img_ext;
        $up_location = 'image/brand/';
        $last_img =$up_location.$new_img_name;
        $brand_img->move($up_location,$new_img_name);
        unlink($old_img);
        Brand::find($id)->update([
            'brand_name'=>$request->brand_name,
            "brand_img"=>$last_img,
            "created_at"=>Carbon::now()
        ]);
        $notification = array(
            'message'=>'Brand Updated Successful',
            'alert-type'=>'info'
        );
    
        return Redirect()->route('All.brand')->with($notification);
    }else{
        Brand::find($id)->update([
            'brand_name'=>$request->brand_name,
            "created_at"=>Carbon::now()
        ]);
        $notification = array(
            'message'=>'Brand Updated Successful',
            'alert-type'=>'info'
        );
    
        return Redirect()->route('All.brand')->with($notification);
    }
    
    
   }
   public function Delete($id){
    $brands = Brand::find($id);
    $old_img = $brands->brand_img;
    unlink($old_img);
    Brand::find($id)->delete();
    $notification = array(
        'message'=>'Brand Deleted Successful',
        'alert-type'=>'warning'
    );
    return Redirect()->back()->with($notification);

    }


    ///////////////// this is multi image
    public function MultiPic(){
        $images = multipic::all();
        return view('admin.multi.index',compact('images'));
    }

    public function AddImage(Request $request){
       
        $image = $request->file('image');

     foreach($image as $multi){

            
        $name_gen = hexdec(uniqid()).$multi->getClientOriginalExtension();
        Image::make($multi)->resize(300,200)->save('image/multi/'.$name_gen);
        $last_img = 'image/multi/'.$name_gen;
        multipic::insert([
        
            "image"=>$last_img,
            "created_at"=>Carbon::now()
        ]);  
     } //end foreach
        $notification = array(
            'message'=>'image Inserted Successful',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function Logout(){
    Auth::logout();

    $notification = array(
        'message'=>'User LOGOUT',
        'alert-type'=>'success'
    );
    return Redirect()->route('login')->with($notification);
    }



}