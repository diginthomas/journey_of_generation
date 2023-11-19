<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UpdateLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RejectAssistance extends Model
{
    use HasFactory,UpdateLogger,SoftDeletes;
    protected $guarded = [];
}
