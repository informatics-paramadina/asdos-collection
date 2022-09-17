<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'dosen',
    ];

    public function getAssignment()
    {
        return $this->hasMany(Assignment::class);
    }
}
