<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    public function AllCat(){
        // $categories = Category::all();
        // $categories = Category::latest()->get();
        $categories = Category::latest()->paginate(5);
        $trachCat = Category:: onlyTrashed()->latest()->paginate(3);
        //# Query builder
        // $categories =  DB::table('categories')->latest()->get();
        // $categories =  DB::table('categories')->latest()->paginate(5);
        // $categories =  DB::table('categories')
        //             ->join('users','categories.user_id','users.id')
        //             ->select('categories.*','users.name')
        //             ->latest()->paginate(5);

        return view('admin.category.index',compact('categories','trachCat'));
    }
    public function AddCat(Request $request){
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',

        ],
        [
            'category_name.required' => 'Please Enter Category Name',
            'category_name.max' => 'Category Name less Than 255 Chars',

        ]
    );
     Category::insert([
        'category_name'=>$request->category_name,
        'user_id'=> Auth::user()->id,
        'created_at'=>Carbon::now()
     ]);

    // $category = new Category;
    // $category ->category_name = $request->category_name;
    // $category ->user_id = Auth::user()->id;
    // $category ->save();
    // query Builder
    //  $date = array();
    //  $date['category_name']= $request->category_name;
    //  $date['user_id']= Auth::user()->id;
    //  DB::table('categories')->insert($date);


     return Redirect()->back()->with('success','Category Inserrted Successfull');

    }
    public function Edit($id){
        // $categories =Category::find($id);
        //#Query Builder
        $categories = DB::table('categories')->where('id',$id)->first();
        return view("admin.category.edit",compact('categories'));
    }
    public function Update(Request $request ,$id){
        $validated = $request->validate([
                'category_name' => 'required|unique:categories|max:255',

            ],
            [
                'category_name.required' => 'Please Enter Category Name',
                'category_name.max' => 'Category Name less Than 255 Chars',

            ]
        );
        // $update = Category::find($id)->update([
        //     'category_name' => $request->category_name,
        //     'user_id'=> Auth::user()->id
        // ]);
        $Update_date = array();
        $Update_date['category_name']= $request->category_name;
        $Update_date['user_id']= Auth::user()->id;
        DB::table('categories')->where('id',$id)->update($Update_date);
        return Redirect()->route('All.Category')->with('success','Category Update Successfull');
    }

    public function softDelete($id){
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success','Category Soft Delete Successfull');

    }
    
    public function Restore($id){
    $delete = Category::withTrashed()->find($id)->restore();
    return Redirect()->back()->with('success','Category Restore Successfull');

    }
    public function PDelete($id){
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success','Category Permanently Deleted Successfull');
    }





















}

