<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class RecallOld extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $connection = 'cencosud_old';
    protected $table = 'recall_supermecados';
}