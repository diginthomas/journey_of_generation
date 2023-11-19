<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\ValidationRepository;
use App\Http\Repositories\CommonRepository;
use App\Models\Friend;
use App\Models\Assistance;
use App\Models\RejectAssistance;
use Carbon\Carbon;

class VolunteerController extends Controller
{
    public function getAssistanceList(Request $request,CommonRepository $commonRepo)
    {
        $status = 2; //approved
        $userId = auth('sanctum')->Id();
        $friendsId = Friend::where('volunteer_id',$userId)
            ->pluck('senior_id');   
        $rejectAssistance =  RejectAssistance::where('volunteer_id',$userId)
              ->pluck('assistance_id');       
        $assistanceList = $commonRepo->getAssistanceList($status)
            ->whereNotIn('senior_id',$friendsId)
            ->whereNotIn('id',$rejectAssistance)
            ->paginate(4);
        foreach($assistanceList as $list){
            $list->formatted_date =  Carbon::parse($list->created_at)->format('M d, Y, h:i:a');
        }    
        $response = ['status' => 'success', 'data' => $assistanceList];
        return response()->json($response, 200);    
    }

    public function acceptAssistanceRequest(Request $request,ValidationRepository $validationRepo)
    {

     $validatedData = $validationRepo->acceptAssistanceFormValidation($request);
      if ($validatedData->fails()) {
        $response = ['status' => 'validationError', 'messages' => $validatedData->messages()];
        $statusCode = 403;
      }else{
        $userId = auth('sanctum')->Id();
        $assistance = Assistance::find($request->input('assistance_id'));
        $isFriend = Friend::where('senior_id',$assistance->senior_id)
            ->where('volunteer_id',$userId)->exists();
        if(!$isFriend){
            Friend::create(['senior_id'=>$assistance->senior_id,'volunteer_id'=>$userId]);
            $assistance->volunteer_approval = true;
            $assistance->save();
            $response = ['status' => 'success', 'messages' => 'Request approved successfully'];
            $statusCode = 200;
        } else{
          $response = ['status' => 'error', 'messages' => 'Already friends'];
          $statusCode = 403;
        }   
      }
      return response()->json($response, $statusCode);
    }
    public function rejectAssistance(Request $request,ValidationRepository $validationRepo) 
    {
      $validatedData = $validationRepo->acceptAssistanceFormValidation($request);
      if ($validatedData->fails()) {
        $response = ['status' => 'validationError', 'messages' => $validatedData->messages()];
        $statusCode = 403;
      }else{
        $userId = auth('sanctum')->Id();
        $formData = $request->all();
        $formData['volunteer_id'] = $userId;
        RejectAssistance::create($formData);
        $response = ['status' => 'success', 'messages' => 'Request rejected successfully'];
        $statusCode = 200;
      }
      return response()->json($response, $statusCode);
    }
}
