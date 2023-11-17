<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Reclamo extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, Notifiable;
    protected $guarded = [];
    

    public function tienda(): HasOne
    {        
        return $this->hasOne(Tienda::class,'id','id_local');
    }
    public function seccion(): HasOne
    {
        return $this->hasOne(Seccion::class,'codigo','id_seccion');
    }
    public function responsable(): HasOne
    {
        return $this->hasOne(User::class,'id','id_responsable');
    }
    public function responsable_cerrado(): HasOne
    {
        return $this->hasOne(User::class,'id','responsable_cierre')->withDefault();
    }
    public function responsable_rechazo(): HasOne
    {
        return $this->hasOne(User::class,'id','id_responsable_rechazo')->withDefault();
    }
    public function origen_reclamo(): HasOne
    {
        #return $this->belongsTo(Tienda::class,'COLUMAN EN TABLA LOCAL' , 'COLUMNA EN TABLA DONDE SE BUSCA');
        return $this->hasOne(OrigenesReclamos::class,'id','origen')->withDefault(['nombre' => 'No Definido']);
    }
    public function reclamos_local_problema(): HasMany
    {
        #return $this->belongsTo(Tienda::class,'COLUMAN EN TABLA LOCAL' , 'COLUMNA EN TABLA DONDE SE BUSCA');
        return $this->HasMany(ReclamoLocalProblema::class,'id_reclamo','id');
    }
    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id');
    }
    /*public function tienda(): BelongsTo
    {        
        return $this->belongsTo(Tienda::class,'id_local','id');
    }
    public function seccion(): BelongsTo
    {
        return $this->belongsTo(Seccion::class,'id_seccion','id');
    }
    public function responsable(): BelongsTo
    {
        return $this->belongsTo(User::class,'id_responsable','id');
    }
    public function origen_reclamo(): BelongsTo
    {
        #return $this->belongsTo(Tienda::class,'COLUMAN EN TABLA LOCAL' , 'COLUMNA EN TABLA DONDE SE BUSCA');
        return $this->belongsTo(OrigenesReclamos::class,'origen','id')->withDefault(['nombre' => 'No Definido']);
    }*/
}

