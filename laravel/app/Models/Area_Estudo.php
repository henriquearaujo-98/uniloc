<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area_Estudo extends Model
{
    use HasFactory;

    protected $fillable = [
        'ID',
        'nome'
    ];

    protected $table = 'area_estudo';
    public $timestamps = false;
    protected $primaryKey = 'ID';
    public $incrementing = false;

    public function cursos(){
        $this->hasMany(Curso::class, 'area_curso_ID' , 'ID');
    }
}
