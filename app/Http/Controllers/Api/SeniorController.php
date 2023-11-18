<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assistance;

class SeniorController extends Controller
{
   
    public function requestAssistance(Request $request)
    {
        $user = auth('sanctum')->user();
        if($user->role!=2){
            $response = ['status'=>'error','message'=>'only seniors can request assistance!'];
            $statusCode = 403;
        }else{
            $formData = $request->all();
            $formData['senior_id'] = $user->id;
            Assistance::create($formData);
            $response = ['status'=>'success','message'=>'Successfully sent assistance request'];
            $statusCode = 200;
             //send notification to admin
        }
    
        return response()->json($response,$statusCode);
 
    }
}
