<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UpdateLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model
{
    use HasFactory, UpdateLogger, SoftDeletes;

    protected $guarded = [];

    public function author():BelongsTo
    {
        return $this->belongsTo(User::class,'created_by');
    }
    public function blogLikes(): HasMany
    {
        return $this->hasMany(BlogLike::class);
    }
}
