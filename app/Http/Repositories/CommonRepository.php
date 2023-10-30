<?php

namespace App\Http\Repositories;
use App\Models\User;
use App\Models\Picnic;
use App\Models\Blog;
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

  public function getUsers($acive = true)
  {
    return User::when($active == true, function($query){
      $query->where('status', 1);
    })
    ->latest();
  }

  public function getBlogs($active = true)
  {
    return Blog::with([
      'author:id,first_name,last_name'
    ])
    ->when($active == true, function($query) {
      $query->where('status', 1);
    })
    ->select('id', 'title', 'description', 'image', 'status', 'created_by', 'created_at')
    ->latest();
  }

}
