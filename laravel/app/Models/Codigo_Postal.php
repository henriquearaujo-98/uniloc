<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Codigo_Postal extends Model
{
    use HasFactory;

    protected $fillable = [
        'cod_postal',
        'cidade_ID'
    ];

    protected $table = 'codigos_postais';
    public $timestamps = false;
    protected $primaryKey = 'cod_postal';
    public $incrementing = false;

    public function cidade(){
        return $this->belongsTo(Cidade::class, 'cidade_ID', 'ID');
    }

    public function instituicoes(){
        return $this->hasMany(Instituicao::class, 'cod_postal','cod_postal');
    }
}
