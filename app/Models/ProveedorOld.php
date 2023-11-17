<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class ProveedorOld extends Model
{
    use HasFactory;
    protected $guarded = [];    
    protected $connection = 'cencosud_old';
    protected $table = 'db_jumbo_proveedor';

    public function proveedor_reclamo(): HasMany
    {
        return $this->HasMany(ReclamoOld::class,'proveedor','rut_proveedor');
    }
}