<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseMovie extends Model
{
    use HasFactory;
    protected $table = "course_movies";
    protected $guarded = [];
    
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
}
