<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
class Seccion extends Model
{
    use HasFactory ,SoftDeletes;
    protected $table = 'secciones';
    protected $guarded = [];
    public function reclamo(): HasOne
    {
        return $this->hasOne(Reclamo::class);
    }
    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_seccion');
    }
}
