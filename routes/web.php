<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ChangePass;
use App\Models\multipic;
use App\Models\Contact;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $Slider = DB::table('sliders')->get();
    $about = DB::table('aboutuses')->get();
    $images = multipic::all();
  
    return view('home',compact('brands','Slider','about','images'));
});
// category controller
Route::get('/category/all',[CategoryController::class,'AllCat'])->name('All.Category');
Route::post('/category/add',[CategoryController::class,'AddCat'])->name('store.category');
Route::get('/category/edit/{id}',[CategoryController::class,'Edit']);
Route::post('/category/update/{id}',[CategoryController::class,'Update']);
Route::get('/softdelete/category/{id}',[CategoryController::class,'softDelete']);
Route::get('/category/restore/{id}',[CategoryController::class,'Restore']);
Route::get('/pdelete/category/{id}',[CategoryController::class,'PDelete']);

// Brand controller
Route::get('/brand/all',[BrandController::class,'AllBrand'])->name('All.brand');
Route::post('/brand/add',[BrandController::class,'AddBrand'])->name('store.brand');
Route::get('/brand/edit/{id}',[BrandController::class,'Edit']);
Route::post('/brand/update/{id}',[BrandController::class,'Update']);
Route::get('/brand/delete/{id}',[BrandController::class,'Delete']);

//Multi Images #protfulie
Route::get('/multi/image',[BrandController::class,'MultiPic'])->name('multi.image');
Route::post('/multi/add',[BrandController::class,'AddImage'])->name('store.image');
//SLider controller
Route::get('/slider/all',[SliderController::class,'AllSlider'])->name('All.Slider');
Route::post('/slider/add',[SliderController::class,'AddSlider'])->name('store.slider');
Route::get('/slider/edit/{id}',[SliderController::class,'Edit']);
Route::post('/slider/update/{id}',[SliderController::class,'Update']);
Route::get('/slider/delete/{id}',[SliderController::class,'Delete']);
//Aboute controller
Route::get('/home/about',[AboutController::class,'HomeAbout'])->name('Home.About');
Route::post('/about/add',[AboutController::class,'AddAbout'])->name('store.about');
Route::get('/about/edit/{id}',[AboutController::class,'Edit']);
Route::post('/about/update/{id}',[AboutController::class,'Update']);
Route::get('/about/delete/{id}',[AboutController::class,'Delete']);
// portfolio Home
Route::get('/portfolio',[AboutController::class,'Portfolio'])->name('portfolio');
// Contact page
Route::get('/home/contact',[ContactController::class,'HomeContact'])->name('Home.Contact');
Route::post('/contact/add',[ContactController::class,'AddContact'])->name('store.contact');
Route::get('/contact/edit/{id}',[ContactController::class,'Edit']);
Route::post('/contact/update/{id}',[ContactController::class,'Update']);
Route::get('/contact/delete/{id}',[ContactController::class,'Delete']);
Route::get('/contact',[ContactController::class,'PageContact'])->name('Page.Contact');
// contact message
Route::post('/contact/form',[ContactController::class,'AddMessage'])->name('addMessage');
Route::get('/contact/massage',[ContactController::class,'ContactMessage'])->name("show.message");
Route::get('/message/delete/{id}',[ContactController::class,'DeleteMessage']);




Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users =User::All();
    // $users = DB::table('users')->get();
    return view('admin.index');
})->name('dashboard');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/user/logout',[BrandController::class,'Logout'])->name('user.logout');

////User password
Route::get('/user/password',[ChangePass::class,'CPassword'])->name('change.password');
Route::post('/password/update',[ChangePass::class,'UpdatePassword'])->name('password.update');
// Profile user
Route::get('/user/profile',[ChangePass::class,'PUpdate'])->name('profile.update');
Route::post('/profile/update',[ChangePass::class,'ChangeProfile'])->name('profile.change');