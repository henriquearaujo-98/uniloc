<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instituicao_has_Curso extends Model
{

    use \Awobaz\Compoships\Compoships;

    protected $fillable = [
        'cursos_ID',
        'instituicoes_ID',
        'nota_ult_1fase',
        'nota_ult_2fase',
        'plano_curso',
    ];

    protected $table = 'instituicoes_has_curso';
    public $timestamps = false;
    protected $primaryKey = 'ID';
    public $incrementing = false;

    public function instituicao(){
        return $this->HasMany(Instituicao::class, 'ID', 'instituicoes_ID');

    }

    public function curso(){
        return $this->HasMany(Curso::class, 'ID', 'cursos_ID');

    }

    public function provas(){
        return $this->HasMany(Prova_Ingresso::class, ['cursoID', 'instituicoes_ID'], ['cursos_ID', 'instituicoes_ID']);
    }


    public static function find($cursoID, $instID){
        return Instituicao_has_Curso::where('cursos_ID', $cursoID)->where('instituicoes_ID', $instID)->get();
    }

}
