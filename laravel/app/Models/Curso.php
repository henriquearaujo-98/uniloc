<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'ID',
        'nome',
        'area_curso_ID'
    ];

    protected $table = 'cursos';
    public $timestamps = false;
    protected $primaryKey = 'ID';
    public $incrementing = false;

    public function instituicoes(){
        return $this->belongsToMany(Instituicao::class,
                        'instituicoes_has_curso',
                'cursos_ID', 'instituicoes_ID');
    }

    public function area_estudo(){
        return $this->belongsTo(Area_Estudo::class, 'area_curso_ID', 'ID');
    }
}
