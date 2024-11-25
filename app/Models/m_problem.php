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
        'user_id', // Ensure this is fillable
    ];

    /**
     * Get the user who submitted the problem.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
