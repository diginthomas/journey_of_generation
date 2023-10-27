<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Validator;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        } else {
            return view('login.login');
        }
    }

    public function authenticate(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $validatedData = Validator::make($request->all(), [
            'email' => 'bail|email|required',
            'password' => 'bail|required',
        ]);
        if ($validatedData->fails()) {
            $data['error'] = "Enter valid email/password";
            return redirect(route('login'))->with($data);
        }
        if (Auth::attempt(['email' => $email, 'password' => $password, 'role' => 1, 'status' => 1])) {
            return redirect(route('dashBoard'));
        }
        $data['error'] = "Incorrect email/password";
        return redirect(route('login'))->with($data);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect(route('login'));
    }
}
