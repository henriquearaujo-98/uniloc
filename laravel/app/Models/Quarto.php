<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quarto extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'descricao',
        'MetrosQuadrados',
        'Preco',
        'Localizacao',
        'CasaBanhoPrivada',
        'Recibos',
        'Sexo',
        'NViews',
        'userID'
    ];

    protected $table = 'quarto';
    public $timestamps = false;
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function fotos(){
        $this->hasMany(Fotos_Quartos::class, 'idQuarto' , 'id');
    }

    public function user(){
        return $this->hasMany(User::class, 'userID','id');
    }

    public function quarto(){
        return $this->belongsTo(User::class, 'userID','id');
    }
}
