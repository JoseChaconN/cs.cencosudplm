<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FrigorificoRazonSocial extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'frigorificos_razones_sociales';
    protected $guarded = [];
    public function frigorifico()
    {
        return $this->belongsTo(Frigorifico::class, 'id_frigorifico');
    }
}
