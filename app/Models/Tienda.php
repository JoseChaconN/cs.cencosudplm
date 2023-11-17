<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
class Tienda extends Model
{
    use HasFactory ,SoftDeletes;
    protected $guarded = [];
    
    public function reclamo(): HasOne
    {
        return $this->hasOne(Reclamo::class);
    }
    public function recall(): HasOne
    {
        return $this->hasOne(Recall::class);
    }
}
