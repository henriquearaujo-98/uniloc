<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fotos_Quarto extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'PATH',
        'Name',
        'quartoID'
    ];

    protected $table = 'fotos_quarto';
    public $timestamps = false;
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function quarto(){
        return $this->belongsTo(Quarto::class, 'quartoID','id');
    }
}
