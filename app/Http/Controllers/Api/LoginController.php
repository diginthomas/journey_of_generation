<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\ValidationRepository;
use Carbon\Carbon;
use App\Models\User;

class LoginController extends Controller
{
    public function index(Request $request,ValidationRepository $validationRepo)
    {
        $validated = $this->validateProvider($request->input('provider_name'));
        if (!is_null($validated)) {
            return $validated;
        }
        if ($validationRepo->apiLoginValidation($request)->fails()) {
            $response = [
                'status' => 'validationError',
                'messages' => $validationRepo->apiLoginValidation($request)->messages()
            ];
            $statusCode = 403;
        } else {
            $formData = $request->all();
            $formData['status']= true;
            $formData['email_verified_at'] =  Carbon::now();
            $userCreated = User::firstOrCreate(['provider_name' => $formData['provider_name'],
                'provider_id' =>$formData['provider_id']],$formData);
            $token = $userCreated->createToken(config('app.name'))->plainTextToken;
            $response = ['status' => 'success','user'=>$userCreated,'token' => $token];
            $statusCode=200;
        }
        return response()->json($response,$statusCode);
    }

    public function logout()
    {
        $user = auth('sanctum')->user();
        $user->tokens()->delete();
        return response()->json(['status' => 'success','message' => 'Successfully logged out']);
    }

    protected function validateProvider($provider)
    {
        if (!in_array($provider, ['facebook', 'google'])) {
            return response()->json(['error' => 'Please login using facebook or google'], 422);
        }
    }
}
