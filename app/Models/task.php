<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'status',
    ];
    function team (){
        return $this->belongsTo(team::class , 'team_id') ;
        }
}
