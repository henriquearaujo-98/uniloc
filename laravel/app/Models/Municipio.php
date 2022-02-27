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
        'distritos_ID'
    ];

    protected $table = 'municipios';
    public $timestamps = false;
    protected $primaryKey = 'ID';
    public $incrementing = false;

    public function distrito(){
        return $this->belongsTo(Distrito::class, 'distritos_ID', 'ID');
    }

    public function informacoes(){
        return $this->hasOne(Informacoes_Municipio::class, 'municipio_ID', 'ID');
    }

    public function cidades(){
        return $this->hasMany(Cidade::class, 'municipio_ID', 'ID');
    }
}
