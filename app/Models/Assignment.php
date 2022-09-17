<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'allowed_extensions',
        'have_deadline',
        'open_at',
        'closed_at',
    ];

    public function getResponse()
    {
        return $this->hasMany(Response::class);
    }
}
