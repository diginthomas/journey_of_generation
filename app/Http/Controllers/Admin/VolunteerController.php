<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\CommonRepository;
use Carbon\Carbon;

class VolunteerController extends Controller
{
    private $role ;
    public function __construct()
    {
        $this->role = 3;
    }
    
    public function index(){
        return view('volunteers.list');
    }
    public function volunteerList(Request $request, CommonRepository $commonRepo)
    {
        $columns = array('sl_no', 'name', 'email', 'phone', 'address','dob','location','status','action');
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
                $nestedData['address'] = $user->address;
                $dob = Carbon::parse($user->date_of_birth)->format('M d, Y');
                $nestedData['dob'] = $dob;
                $nestedData['location']= $user->city.",".$user->Country;
                if ($user->status == 1) {
                  $nestedData['status'] = config('buttons.active');
                } else {
                  $nestedData['status'] = config('buttons.inactive');
                }
                $nestedData['action'] = '';
    
                $nestedData['action'] .= '<a href=""
                class="'.config('buttons.view-class').'" title="View"> '.config('buttons.view-icon').'</a>&nbsp;&nbsp;';
    
                // $nestedData['action'] .= '<a href="'.route('editPicnic', base64_encode($picnic->id)).'"
                // class="'.config('buttons.edit-class').'" title="Edit"> '.config('buttons.edit-icon').'</a>&nbsp;&nbsp;';
    
                // $nestedData['action'] .= '<a href="javascript:void(0)" data-id="'.$picnic->id.'"
                // class="'.config('buttons.delete-class').'" title="Delete"> '.config('buttons.delete-icon').'</a>&nbsp;&nbsp;';
    
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
