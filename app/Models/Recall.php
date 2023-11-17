<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Recall extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;
    protected $guarded = [];
    public function tienda(): HasOne
    {        
        return $this->hasOne(Tienda::class,'id_local','id');
    }
    public function responsable(): HasOne
    {
        return $this->hasOne(User::class,'id_responsable','id');
    }
    public function recall_respuesta(): BelongsTo
    {
        return $this->belongsTo(RecallRespuesta::class,'id_recall','id');
    }
    /* public function respuesta_recall(): HasOne
    {
        return $this->hasOne(Recall::class);
    } */
    public function respuesta_recall(): HasMany
    {
        return $this->hasMany(RecallRespuesta::class,'id_recall','id');
    }
}
