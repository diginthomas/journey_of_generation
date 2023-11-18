<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\CommonRepository;
use Carbon\Carbon;
use App\Models\Assistance;

class AssistanceController extends Controller
{
    public function index()  {
        return view('assistance.list');
    }
    public function assistanceList(Request $request,CommonRepository $commonRepo)  {
        $columns = array('sl_no', 'name', 'message', 'date', 'status','action');
        $limit = $request->input('length');
        $start = $request->input('start');
        $status = $request->input('status');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        $totalData = $commonRepo->getAssistanceList()->count();
        $assistanceList = $commonRepo->getAssistanceList($status)
            ->when($order == 'sl_no', function ($query) use ($dir) {
                $query->orderBy('created_at', $dir);
            })
            ->when($search != '', function ($query) use ($search) {
                // $query->where(function ($subquery) use ($search) {
                //     $subquery->orWhere('first_name', 'LIKE', "%{$search}%")
                //         ->orWhere('last_name','LIKE',"%{$search}%");
                // });
            });
        if (empty($search)) {
            $totalFiltered = $totalData;
            $assistanceList = $assistanceList->when($limit > 0, function ($query) use ($start, $limit) {
                $query->offset($start)
                    ->limit($limit);
            })->get();
        } else {
            $totalFiltered = $assistanceList->count();
            $assistanceList = $assistanceList->when($limit > 0, function ($query) use ($start, $limit) {
                $query->offset($start)
                    ->limit($limit);
            })
            ->get();
        }
        $data = [];
            if(!empty($assistanceList))
            {
                foreach($assistanceList as $assistance)
                {
                    /* 'DT_RowId' (default name for DataTables to assign row ids) to set the row id for the dataTable - important */
                    $nestedData['DT_RowId'] = 'row_'.$assistance->id;
                    $senior  = $assistance->senior;
                    $nestedData['name'] = $senior->first_name." ".$senior->last_name;
                    $nestedData['message']= $assistance->message;
                    $nestedData['date'] = Carbon::parse($assistance->created_at)->format('M d, Y, h:i:a');

                    if ($assistance->status == 1) {
                    $nestedData['status'] = config('buttons.pending');
                    } else  if($assistance->status == 2){
                    $nestedData['status'] = config('buttons.approved');
                    }else{
                        $nestedData['status'] = config('buttons.rejected');
                    }
                    $nestedData['action'] = '';
                    if($assistance->status == 1){
                        $nestedData['action'] .= '<a href="javascript:void(0)" data-id="'.$assistance->id.'"
                        class="'.config('buttons.approve-class').'" title="Approve"> '.config('buttons.approve-icon').'</a>&nbsp;&nbsp;';
            
                        $nestedData['action'] .= '<a href="javascript:void(0)" data-id="'.$assistance->id.'"
                        class="'.config('buttons.reject-class').'" title="Reject"> '.config('buttons.reject-icon').'</a>&nbsp;&nbsp;';
                    }
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
    public function assistanceRequestStatus(Request $request)
    {
        $assistanceReq = Assistance::find($request->input('id'));
        $status =  $request->input('status');
        if(!empty($assistanceReq) && !empty($status) && $assistanceReq->status!=3){
            $assistanceReq->status = $status;
            $assistanceReq->save();
            //send notification to user
            $response = ['status' => 'success', 'message' => 'Status Changed Successfully'];     
        }
        else{
            $response = ['status' => 'error', 'message' => 'Please try again'];     
        }  
         
        return response()->json($response);     
    }
}
// 8891398481