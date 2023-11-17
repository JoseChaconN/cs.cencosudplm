<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
#use HasRoles;

use App\Models\ActivityLog;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , SoftDeletes;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'area',
        'cargo',
        'perfil_cs',
        'perfil_aca',
        'rol_aca',
        'perfil_cd',
        'status',
        'password',
        'ultima_conexion'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function booted()
    {
       
    }
    /*public function reclamo(): HasOne
    {
        return $this->hasOne(Reclamo::class);
    }*/
    public function reclamos(): HasMany
    {
        return $this->HasMany(Reclamo::class,'id_responsable','id');
    }
    public function recall(): HasMany
    {
        return $this->HasMany(Recall::class,'id_responsable','id');
        #return $this->hasOne(Recall::class);
    }
    public function respuesta_recall(): HasMany
    {
        return $this->HasMany(RecallRespuesta::class,'id_responsable','id');
        #return $this->hasOne(Recall::class);
    }
    public function rechazos(): HasMany
    {
        return $this->HasMany(Rechazo::class,'id_responsable','id');
    }
    
}
