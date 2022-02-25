<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_Ensino extends Model
{
    use HasFactory;

    protected $fillable = [
        'ID',
        'nome'
    ];

    protected $table = 'tipos_ensino';
    public $timestamps = false;
    protected $primaryKey = 'ID';
    public $incrementing = false;

    public function Instituicao(){
        $this->hasMany(Instituicao::class, 'tipos_ensino_ID', 'ID');
    }
}
