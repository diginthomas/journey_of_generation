<?php

namespace App\Http\Repositories;
use Validator;

class ValidationRepository
{
  public function picnicFormValidation($request): object
  {
    return Validator::make($request->all(),[
      'title' => 'bail|required|min:3|max:30',
      'location' => 'bail|required',
      'date' => 'bail|required',
      'description' => 'bail|required',
      'agenda' => 'bail|required',
      'image'=> 'bail|image|mimes:jpeg,jpg,png|max:5120',
    ],[
      'title.required' => 'Title is mandatory.',
      'location.required' => 'Location is mandatory.',
      'date.required' => 'Date is mandatory.',
      'description.required' => 'Description is mandatory.',
      'agenda.required' => 'Agenda is mandatory.'
    ]);
  }

  public function blogFormValidation($request): object
  {
    return Validator::make($request->all(),[
      'title' => 'bail|required|unique:blogs,title,'.$request->input('id').',id,deleted_at,NULL',
      'image'=> 'bail|image|mimes:jpeg,jpg,png|max:5120',
      'description' => 'required'
    ],[
      'title.required' => 'Title is mandatory.',
      'description.required' => 'Description is mandatory.'
    ]);
  }

  public function quoteFormValidation($request): object{
    return Validator::make($request->all(),[
        'quote'=>'bail|required',
      ],[
      'quote.required'=>'Quote is mandatory']
    );
  }
  public function apiLoginValidation($request)  {
    return Validator::make($request->all(),[
      'email' => 'bail|required|email',
      'first_name' => 'bail|required',
      'role' => 'bail|required',
      'provider_name' => 'bail|required',
      'provider_id'=> 'bail|required',
    ],[
      'first_name.required' => 'first_name is mandatory.',
      'role.required' => 'Role is mandatory.',
      'date.required' => 'Date is mandatory.',
      'provider_name.required' => 'Provider name is mandatory.',
      'provider_id.required' => 'Provider id is mandatory.',
      'email.email' => 'Invalid email',
    ]);
  }

  public function validateBlogLike($request)  {
    return Validator::make($request->all(),[
      'like'=>'bail|required',
      'blog_id'=>'bail|required',
    ],[
    'like.required'=>'like is mandatory',
    'blog_id.required'=>'blog id is mandatory']
  );
  }

}
