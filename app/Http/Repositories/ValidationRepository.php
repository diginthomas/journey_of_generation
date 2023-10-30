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
      'agenda' => 'bail|required'
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

}
