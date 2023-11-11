<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Log;
use App\Models\User;
use GuzzleHttp\Exception\ClientException;
use Carbon\Carbon;

class SocialLoginController extends Controller
{
    public function redirectToProvider(Request $request,$provider)  
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }
        $role = $request->input('role');
        return Socialite::driver($provider)
                ->stateless()
                ->with(['role' => 'role'])
                ->redirect();
         
    }
    public function handleCallBack($provider) 
    {   
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }

        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (ClientException $exception) {
            // throw $exception;
            Log::info($exception);
            return response()->json(['error' => 'Invalid credentials provided.'], 422);
        }
        //dd($user);
        $user_details = $user->user;
        $userCreated = User::firstOrCreate(
            [
                'provider_name' => $provider,
                'provider_id' => $user->getId(),
            ],
            [
                'email_verified_at' => Carbon::now(),
                'email' => $user->getEmail(),
                'first_name' => $user_details['given_name'],
                'last_name'=>$user_details['family_name'] ,
                'image' => $user_details['picture'],
                'provider_name' => $provider,
                'provider_id' => $user->getId(),
                'status' => true,
                'role'=>2,
            ]
        );

        $token = $userCreated->createToken(config('app.name'))->plainTextToken;
        return response()->json($userCreated, 200, ['Access-Token' => $token]);

    }

    protected function validateProvider($provider)
    {
        if (!in_array($provider, ['facebook', 'google'])) {
            return response()->json(['error' => 'Please login using facebook or google'], 422);
        }
    }
}
