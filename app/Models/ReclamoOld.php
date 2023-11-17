<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
class ReclamoOld extends Model
{
    use HasFactory;
    protected $guarded = [];    
    protected $connection = 'cencosud_old';
    protected $table = 'reclamos_supermecados';

    public function reclamo_proveedor(): HasOne
    {
        return $this->HasOne(ProveedorOld::class,'rut_proveedor','rut_proveedor');
    }
}