<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prova_Ingresso extends Model
{
    use HasFactory;

    protected $fillable = [
        'ID',
        'cursoID',
        'instituicoes_ID',
        'exames_ID'
    ];

    protected $table = 'provas_ingresso';

    public function curso_instituicao(){
        return $this->belongsTo(Instituicao_has_Curso::class, ['cursoID', 'instituicoes_ID'], ['cursos_ID', 'instituicoes_ID']);
    }

}
