<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favoritelist extends Model
{
    use HasFactory;
    protected $table = "favorite_list";
    protected $guarded = [];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
