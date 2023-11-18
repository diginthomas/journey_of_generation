<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UpdateLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assistance extends Model
{
    use HasFactory,SoftDeletes,UpdateLogger;
   
    protected $guarded = [];

    public function senior():BelongsTo
    {
        return $this->belongsTo(User::class,'senior_id');
    }
}
