<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_holiday extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject',
        'description',
        'action',
        'date'
    ];

    function user (){
        return $this->belongsTo(user::class , 'user_id') ;
        }
}
