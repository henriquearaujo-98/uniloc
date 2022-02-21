<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $fillable = [
        'ID',
        'nome',
        'distritos_id'
    ];

    protected $table = 'municipios';

    public function distrito(){
        return $this->belongsTo(Distrito::class, 'distritos_id', 'ID');
    }

    public function informacoes(){
        return $this->hasOne(Informacoes_Municipio::class, 'municipio_ID', 'municipio_ID');
    }

    public function cidades(){
        return $this->hasMany(Cidade::class, 'municipio_ID', 'ID');
    }
}
