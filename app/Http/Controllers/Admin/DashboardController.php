<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\CommonRepository;
use App\Models\User;
use Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = User::select('image')->find(Auth::id());
        return view('dashboard.dashboard', compact('user'));
    }

    public function getPicnic(CommonRepository $commonRepo)
    {
      $picnics = $commonRepo->getPicnics(true)
        ->whereDate('date', '>', Carbon::today())
        ->orderBy('date', 'asc')
        ->take(5)
        ->get();
      // foreach ($picnics as $picnic) {
      //   $picnic->id = base64_encode($picnic->id);
      // }
      // dd($picnics);
      $jsonArray = ['status' => 'success', 'picnics' => $picnics];
      return response()->json($jsonArray);
    }
}
