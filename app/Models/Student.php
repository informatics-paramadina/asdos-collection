<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'email',
        'is_active',
        'student_id',
    ];

    public function getCourse() {
        return $this->belongsTo(Course::class);
    }
}
