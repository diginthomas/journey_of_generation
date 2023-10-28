<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = User::select('image')->find(Auth::id());
        return view('dashboard.dashboard', compact('user'));
    }
}
