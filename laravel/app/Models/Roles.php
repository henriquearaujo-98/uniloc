<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $table = 'roles';
    public $timestamps = false;
    protected $primaryKey = 'id';
    public $incrementing = true;

    public function users()
    {
        $this->hasMany(User::class, 'role_id', 'id');
    }
}
