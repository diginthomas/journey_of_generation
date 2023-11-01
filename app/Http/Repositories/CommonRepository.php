<?php

namespace App\Http\Repositories;
use App\Models\User;
use App\Models\Picnic;
use App\Models\Quote;
use Auth;

class CommonRepository
{

  public function getPicnics($active = true)
  {
    return Picnic::when($active == true, function($query){
        $query->where('status', 1);
      })
      ->select('id', 'title', 'location', 'image', 'date', 'description', 'agenda', 'status')
      ->latest();
  }

  public function getUsers($active = true)
  {
    return User::when($active == true, function($query){
        $query->where('status', 1);
      })
      ->latest();
  }
  public function getQuotes()
  {
    return Quote::select('id', 'quote')
      ->latest();

  }

}
