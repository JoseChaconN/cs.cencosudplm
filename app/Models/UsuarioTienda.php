<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UsuarioTienda extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'usuarios_tiendas';

    public function tienda(): HasOne
    {
        return $this->hasOne(Tienda::class, 'id', 'id_tienda');
    }
}
