<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        $user = User::find(auth()->user()->id);
        return view('profile.profile',['user'=>$user]);
    }

    public function edit(){
        $user = User::find(auth()->user()->id);
        return view('profile.edit_profile',['user'=>$user]);
    }
    public function update(Request $request){
        if (!Auth::check()) {
            return response()->json(['error' => 'Error,try again']);
        }
        $validatedData = Validator::make($request->all(), [
            'first_name'=>'bail|required',
            'last_name'=>'bail|required',
            'email' => 'bail|email|required',
            'user_image'=>'bail|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->first()]);
        }
        $user = User::find(auth()->user()->id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->city = $request->input('city');
        $user->country = $request->input('country');
        // fix image uploading
        // if ($request->hasFile('user_image')) {
        //     $image = $request->file('user_image');
        //     $imageName = time() . '.' . $image->getClientOriginalExtension();
        //     $destination=public_path('/uploads/user/images');
        //     $image->move($destination,$imageName);
        //     $user->image = $imageName;
        // }
       
        $user->save();
        return response()->json($user);
    }

    public function changePassword(Request $request){
        if (!Auth::check()) {
            return response()->json(['error' => 'Error,try again']);
        }

        $validatedData = Validator::make($request->all(), [
            'old_password'=>'bail|required',
            'new_password'=>'bail|required|min:8',
            'password_confirmation' => 'bail|min:8|required',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->first()]);
        }
        $user =   $user = User::find(auth()->user()->id);
        if (!Hash::check($request->input('old_password'), $user->password)) {
            return response()->json(['error' => 'Incorrect password!,try again']);
        }
        $user->password = bcrypt($request->input('new_password'));
        $user->save();
        return response()->json(['message'=>'password updated']);
    }
}
