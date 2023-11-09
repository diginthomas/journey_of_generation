<?php
namespace App\Http\Traits;
use Laravel\Sanctum\PersonalAccessToken;
trait CommonFunctions
{

  public function uploadImage($request, $field, $folder)
  {
    if ($request->has($field)) {
      $request->file($field)->storePublicly($folder);
      return $request->file($field)->hashName();
    }
  }
  public function getUserIdFromToken($request)  {
    $token =  $request->bearerToken();    
    $tokenData  = PersonalAccessToken::findToken($token);
    return !empty($tokenData)? $tokenData->tokenable_id:null;
  }
}

