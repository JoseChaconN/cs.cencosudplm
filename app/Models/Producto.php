<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
class Producto extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }
    public function seccion(): HasOne
    {
        return $this->hasOne(Seccion::class,'codigo','id_seccion');
    }
    public function reclamos(): HasMany
    {
        return $this->hasMany(Reclamo::class, 'id_producto', 'id');
    }
}
