<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\CommonRepository;
use Carbon\Carbon;

class WalkGoalController extends Controller
{
    private $role ;
    public function __construct()
    {
        $this->role = 2;
    }

    public function index(Request $request) {
        return view('walk.list');
    }
    public function walkList(Request $request, CommonRepository $commonRepo)
    {
        $columns = array('sl_no', 'name', 'email', 'phone', 'address','dob','location','status');
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        $totalData = $commonRepo->getUsers(false,$this->role)->count();
        $users = $commonRepo->getUsers(false,$this->role)
          ->when($order == 'sl_no', function ($query) use ($dir) {
              $query->orderBy('created_at', $dir);
          })
          ->when($search != '', function ($query) use ($search) {
              $query->where(function ($subquery) use ($search) {
                  $subquery->orWhere('first_name', 'LIKE', "%{$search}%")
                      ->orWhere('last_name','LIKE',"%{$search}%");
              });
          });
          if (empty($search)) {
            $totalFiltered = $totalData;
            $users = $users->when($limit > 0, function ($query) use ($start, $limit) {
                $query->offset($start)
                    ->limit($limit);
            })->get();
        } else {
            $totalFiltered = $users->count();
            $users = $users->when($limit > 0, function ($query) use ($start, $limit) {
                $query->offset($start)
                    ->limit($limit);
            })
            ->get();
        }
        $data = [];
        if(!empty($users))
        {
            foreach($users as $user)
            {
                /* 'DT_RowId' (default name for DataTables to assign row ids) to set the row id for the dataTable - important */
                $nestedData['DT_RowId'] = 'row_'.$user->id;
                $nestedData['name'] = $user->first_name." ".$user->last_name;
                $nestedData['email'] = $user->email;
                $nestedData['phone'] = $user->phone;
                $step = 45;
                $nestedData['date'] = Carbon::now()->format('d M Y');
                $nestedData['steps'] = $step."/100";
                $nestedData['distance'] = '400m';
                if ($step ==100) {
                  $nestedData['status'] = config('buttons.completed');
                } else {
                  $nestedData['status'] = config('buttons.onProgress');
                }
                $nestedData['action'] = '';
                $data[] = $nestedData;
            }
        }
    
        $jsonArray = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
    
        );
        return response()->json($jsonArray);
      
    }
}
