<?php

namespace App\Models;

// use Cviebrock\EloquentSluggable\Sluggable;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory; //Sluggable
    protected $table = "courses";
    protected $guarded = [];
    protected $appends = ['is_sale','persent_sale']; 
    // /**
    //  * Return the sluggable configuration array for this model.
    //  *
    //  * @return array
    //  */
    // public function sluggable()
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'name'
    //         ]
    //     ];
    // }

    public function getIsSaleAttribute()
    {
        return ($this->sale_price != null && $this->date_on_sale_from < Carbon::now() && $this->date_on_sale_to > Carbon::now()) ? true : false;
    }
    public function getPersentSaleAttribute()
    {
        return $this->is_sale ? round((($this->price - $this->sale_price) / $this->price) * 100) : null;
    }

    public function getIsActiveAttribute($is_active)
    {
        return $is_active ? 'فعال' : 'غیرفعال';
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'course_tag');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function attributes()
    {
        return $this->hasMany(CourseAttribute::class);
    }

    public function rates()
    {
        return $this->hasMany(CourseRate::class);
    }
    
    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
    
    public function download_movie()
    {
        return $this->hasMany(CourseMovie::class);
    }
    
    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    public function approvedComments()
    {
        return $this->hasMany(Comment::class)->where('approved', 1)->where('answer_to',null);
    }

    public function scopeFilter($query)
    {
        if (request()->has('attribute')) {
            foreach (request()->attribute as $attribute) {
                $query->whereHas('attributes', function ($query) use ($attribute) {
                    foreach (explode('-', $attribute) as $index => $item) {
                        if ($index == 0) {
                            $query->where('value', $item);
                        } else {
                            $query->orWhere('value', $item);
                        }
                    }
                });
            }
        }

        if (request()->has('sortBy')) {
            $sortBy = request()->sortBy;
            switch ($sortBy) {
                case 'max':
                    $query->orderByDesc('price')->orderBy('sale_price');
                case 'min':
                    $query->orderBy('price')->orderBy('sale_price');
                    break;
                case 'latest':
                    $query->latest();
                    break;
                case 'oldest':
                    $query->oldest();
                    break;
                default:
                    $query;
                    break;
            }
        }
        return $query;
    }

    public function scopeSearch($query)
    {
        $keyword = request()->search;
        if (request()->has('search') && trim($keyword) != '') {
            $query->where('name', 'LIKE', '%' . trim($keyword) . '%');
        }
        return $query;
    }

    public function checkUserFavoritelist($userId)
    {
        return $this->hasMany(Favoritelist::class)->where('user_id',$userId)->exists();
    }
}
