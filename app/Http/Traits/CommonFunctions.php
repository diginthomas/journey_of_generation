<?php
namespace App\Http\Traits;

trait CommonFunctions
{

  public function uploadImage($request, $field, $folder)
  {
    if ($request->has($field)) {
      $request->file($field)->storePublicly($folder);
      return $request->file($field)->hashName();
    }
  }
}
