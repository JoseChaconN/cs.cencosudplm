<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Frigorifico extends Model
{
    use HasFactory, SoftDeletes;    
    protected $guarded = [];
    public function razones_sociales(): HasMany
    {
        return $this->hasMany(FrigorificoRazonSocial::class,'id_frigorifico','id');
    }
}
