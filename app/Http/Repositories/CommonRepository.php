<?php

namespace App\Http\Repositories;
use App\Models\User;
use App\Models\Picnic;
use App\Models\Quote;
use App\Models\Blog;
use App\Models\PicnicMember;
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

  public function getUsers($active = true,$role)
  {
    return User::when($active == true, function($query){
        $query->where('status', 1);
      })
      ->where('role',$role)
      ->latest();
  }
  public function getQuotes()
  {
    return Quote::select('id', 'quote')
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
  public function getPicnicMembers($picnicId)  {
       return PicnicMember::where('picnic_id',$picnicId)
          ->leftJoin('users','users.id','=','picnic_members.user_id')
          ->select('picnic_members.id', 'picnic_members.role', 'picnic_members.created_at','users.email','users.first_name','users.last_name','users.phone')
          // ->with([
          //   'user:id,first_name,last_name'
          // ])
          ->latest();
  }

}
