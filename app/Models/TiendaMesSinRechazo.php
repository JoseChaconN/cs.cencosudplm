<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiendaMesSinRechazo extends Model
{
    use HasFactory;
    protected $table = 'tienda_mes_sin_rechazos';
    protected $guarded = [];
}
