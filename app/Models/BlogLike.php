<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Traits\UpdateLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BlogLike extends Model
{
    use HasFactory,UpdateLogger,SoftDeletes;
    protected $guarded = [];
}
