<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_problem extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject',
        'description',
    ];
    function user (){
        return $this->belongsTo(user::class , 'user_id') ;
        }
}
