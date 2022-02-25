<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
    use HasFactory;

    protected $fillable = [
        'ID',
        'nome',
        'tipos_ensino_ID',
        'cod_postal',
        'rank'
    ];

    protected $table = 'instituicoes';
    public $timestamps = false;
    protected $primaryKey = 'ID';
    public $incrementing = false;

    public function codigo_postal(){
        return $this->belongsTo(Codigo_Postal::class, 'cod_postal','cod_postal');
    }

    public function tipo_ensino(){
        return $this->hasOne(Tipo_Ensino::class, 'tipos_ensino_ID', 'ID');
    }

    public function cursos(){
        return $this->belongsToMany(Curso::class,
            'instituicoes_has_curso',
            'instituicoes_ID', 'cursos_ID');
        //$this->hasMany(Instituicao_has_Curso::class, 'instituicoes_ID', 'ID');

    }
}
