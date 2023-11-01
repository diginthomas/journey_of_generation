<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\UpdateLogger;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PicnicDetails extends Model
{
    use HasFactory,UpdateLogger, SoftDeletes;

    public function picnic():BelongsTo
    {
        return $this->belongsTo(Picnic::class,'picnic_id');
    }
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
