<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListadoDocumentos extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'listado_documentos';
    protected $guarded = [];
}
