<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\CommonRepository;
use App\Models\User;
use App\Models\PicnicMember;
use Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = User::select('image')->find(Auth::id());
        return view('dashboard.dashboard', compact('user'));
    }

    public function getChart()
    {
      if (PicnicMember::count() > 0) {
        $monthlyTotalSeniors = [];
        $monthlyTotalVolunteers = [];
        $currentMonth = date("m"); // Month Digit without leading zero

        for( $i = 1; $i <= $currentMonth; $i++) {

          $startDate = Carbon::createFromFormat('Y/m/d', date('Y') . '/' . $i . '/1');  // eg:- 2019/1/1
          $endDate = $startDate->copy();
          $endDate->endOfMonth();

          $thisMonthTotalSeniors = PicnicMember::where('role', 2)
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->count();
          $thisMonthTotalVolunteers  = PicnicMember::where('role', 3)
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->count();

          $monthlyTotalSeniors[] = $thisMonthTotalSeniors;
          $monthlyTotalVolunteers[] = $thisMonthTotalVolunteers;

        }
        $currentYear = date("Y");
        $jsonArray = [
          'status' => 'success',
          'currentYear' => $currentYear,
          'totalSeniors' => $monthlyTotalSeniors,
          'totalVolunteers' => $monthlyTotalVolunteers
        ];
      } else {
        $errorHtml = '<div class="dashboard-error-chart">
          <h4 class="dashboard-error-heading">There is no joins</h4>
        </div>';
        $jsonArray = ['status' => 'error', 'errorHtml' => $errorHtml];
      }
      return response()->json($jsonArray);
    }

    public function getPicnic(CommonRepository $commonRepo)
    {
      $picnics = $commonRepo->getPicnics(true)
        ->whereDate('date', '>', Carbon::today())
        ->orderBy('date', 'asc')
        ->take(5)
        ->get();
      $jsonArray = ['status' => 'success', 'picnics' => $picnics];
      return response()->json($jsonArray);
    }
}
