<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\UpdateLogger;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Picnic extends Model
{
    use HasFactory, UpdateLogger, SoftDeletes;

    protected $guarded = [];

    public function picnicMembers():HasMany
    {
        return $this->hasMany(PicnicMember::class,'picnic_id');
    }
}
