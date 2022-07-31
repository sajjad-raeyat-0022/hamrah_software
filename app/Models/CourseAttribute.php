<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseAttribute extends Model
{
    use HasFactory;
    protected $table = "course_attributes";
    protected $guarded = [];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
