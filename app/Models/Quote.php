<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\UpdateLogger;
class Quote extends Model
{
    use HasFactory,SoftDeletes,UpdateLogger;
    protected $guarded = [];
}
