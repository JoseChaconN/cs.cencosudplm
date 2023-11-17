<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecallRespuesta extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'recalls_respuestas';
    protected $guarded = [];
    public function recall_respuesta(): HasMany
    {
        return $this->HasMany(Recall::class);
    }
    
    public function recall(): BelongsTo
    {        
        return $this->belongsTo(Recall::class,'id_recall','id');
    }
}
