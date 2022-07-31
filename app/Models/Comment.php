<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Course;


class Comment extends Model
{
    use HasFactory , SoftDeletes;
    protected $table = 'comments';
    protected $guarded = [];

    public function getApprovedAttribute($approved)
    {
        return $approved ? 'تایید شده' : 'تایید نشده';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
