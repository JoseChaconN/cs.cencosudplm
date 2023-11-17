<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ReclamoLocalProblema extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'reclamos_locales_problema';
    protected $guarded = [];

    public function responsable(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'id_usuario');
    }

    public function tienda(): HasOne
    {
        return $this->hasOne(Tienda::class, 'id', 'id_tienda');
    }
}
