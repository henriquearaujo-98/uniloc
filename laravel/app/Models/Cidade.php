<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    use HasFactory;

    protected $fillable = [
        'ID',
        'nome',
        'municipio_ID'
    ];

    protected $table = 'cidades';

    public function municipio(){
        return $this->belongsTo(Municipio::class, 'municipio_ID','ID');
    }

    public function codigos_postais(){
        return $this->hasMany(Codigo_Postal::class, 'cod_postal', 'ID');
    }
}
