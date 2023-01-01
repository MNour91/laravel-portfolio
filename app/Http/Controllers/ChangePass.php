<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePass extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function CPassword(){
    return view('admin.body.change_password');
    
    }
    public function UpdatePassword(Request $request){
        $validateDate =$request->validate([
            'oldpassword'=>'required',
            'password'=>'required|confirmed'
        ]);
        $hashpassword= Auth::user()->password;
        if(Hash::check($request->oldpassword,$hashpassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success','Password Is Change Successfuly');
        }else{
            return redirect()->back()->with('error','Current Password Is Invalid');

        }
        
    }
    public function PUpdate(){
        if(Auth::user()){
           $user = User::find(Auth::user()->id);
           if($user){
               return view('admin.body.profile_update',compact('user'));
           } 
        }
    }
    public function ChangeProfile(Request $request){
        $id = Auth::user()->id;
        $user = User::find($id);
        if($user->email == $request->email && $user->name == $request->name ){
            return redirect()->route('dashboard');
        }elseif($user->email == $request->email && $user->name != $request->name){
            User::find($id)->update([
                'name'=>$request->name,
            ]);
            return redirect()->route('dashboard')->with('success','User Name Is Changed Successfuly');
        }elseif($user->email != $request->email && $user->name == $request->name){
            User::find($id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'email_verified_at'=> Null,

            ]);
            Auth::logout();
            return redirect()->route('login')->with('success','Email Is Changed Successfuly');
            
        }
    }
}
