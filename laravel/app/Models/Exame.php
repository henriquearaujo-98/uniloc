<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exame extends Model
{
    use HasFactory;

    protected $fillable = [
        'ID',
        'nome'
    ];

    protected $table = 'exames';
    public $timestamps = false;
    protected $primaryKey = 'ID';
    public $incrementing = false;

    public function prova_ingresso(){
        $this->belongsTo(Prova_Ingresso::class, 'Codigo', 'exames_id');
    }

}
