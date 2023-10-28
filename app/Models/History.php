<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UpdateLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class History extends Model
{
    use HasFactory,UpdateLogger,SoftDeletes;
}
