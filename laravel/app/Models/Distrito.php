<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    use HasFactory;

    protected $fillable = [
        'ID',
        'Nome'
    ];

    protected $table = 'distritos';
    public $timestamps = false;
    protected $primaryKey = 'ID';
    public $incrementing = false;

    public function municipios(){
        return $this->hasMany(Municipio::class, 'distritos_id', 'ID');
    }
}
