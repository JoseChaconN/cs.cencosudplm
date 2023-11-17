<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrigenesReclamos extends Model
{
    use HasFactory;
    protected $table = 'origenes_reclamos';
    public function reclamo(): HasOne
    {
        return $this->hasOne(Reclamo::class);
    }
}
