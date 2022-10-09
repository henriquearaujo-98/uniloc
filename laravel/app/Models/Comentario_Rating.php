<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario_Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'Comentario',
        'Rating',
        'NViews',
        'quartoID',
        'userID'
    ];

    protected $table = 'comentario_rating';
    public $timestamps = false;
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function quarto(){
        return $this->HasMany(Quarto::class, 'id', 'quartoID');
    }

    public function quarto_relation(){
        return $this->belongsTo(Quarto::class, 'quartoID', 'id');
    }

    public function user(){
        return $this->HasMany(User::class, 'id', 'userID');
    }

    public function user_relation(){
        return $this->belongsTo(User::class, 'userID', 'id');
    }
}
