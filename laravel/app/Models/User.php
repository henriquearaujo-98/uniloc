<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'instituicao_ID',
        'curso_ID',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function instituicao(){
        return $this->hasOne(Instituicao::class, 'ID','instituicao_ID');
    }

    public function curso()
    {
        return $this->hasOne(Curso::class, 'ID', 'curso_ID');
    }

    public function quarto(){
        return $this->hasMany(Quarto::class, 'userID' , 'id');
    }

    public function comentario_rating(){
        return $this->hasMany(Comentario_Rating::class, 'userID' , 'id');
    }

    public function role(){
        return $this->belongsTo(Roles::class, 'role_id', 'id');
    }
}
