<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal_Access_Token extends Model
{
    use HasFactory;

    protected $table = "personal_access_tokens";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'tokenable_id',
        'token'

    ];

    public function user(){
        return $this->hasOne(User::class, 'id','tokenable_id');
    }
}
