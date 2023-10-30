<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UpdateLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    use HasFactory, UpdateLogger, SoftDeletes;

    protected $guarded = [];

    public function author():BelongsTo
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
