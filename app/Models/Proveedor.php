<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Proveedor extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'Proveedores';
    protected $guarded = [];
    public function secciones_proveedor(): HasMany
    {
        return $this->HasMany(ProveedorSeccion::class,'id_proveedor','id');
    }
    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class, 'id_proveedor');
    }
    public function reclamos(): hasMany
    {
        return $this->hasMany(Reclamo::class, 'id_proveedor', 'id');
    }
}
