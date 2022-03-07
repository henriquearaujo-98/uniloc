<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prova_Ingresso extends Model
{
    use HasFactory;
    use Compoships;

    protected $fillable = [
        'ID',
        'cursoID',
        'instituicoes_ID',
        'exames_ID'
    ];

    protected $table = 'provas_ingresso';
    public $timestamps = false;
    protected $primaryKey = 'ID';
    public $incrementing = false;

    public function curso_instituicao(){
        return $this->belongsTo(Instituicao_has_Curso::class, ['cursoID', 'instituicoes_ID'], ['cursos_ID', 'instituicoes_ID']);
    }

   /* public function exames(){
        return $this->hasMany(Exame::class, '0', '0');
    }*/

    public function cursos(){
        return $this->belongsTo(Instituicao_has_Curso::class, 'cursoID', 'cursos_ID');
    }

    public function insts(){
        return $this->belongsTo(Instituicao_has_Curso::class, 'instituicoes_ID', 'instituicoes_ID');
    }

}
