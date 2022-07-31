<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function all_courses(Course $course){
        $this->SEOToolsMethods();
        if (!empty($_GET['search'])) {
            $keyword = $_GET['search'];
            $courses = $course->where('name', 'LIKE', '%' . trim($keyword) . '%')->paginate(12);
        }
        else if(!empty($_GET['coupon'])){
            $coupon = $_GET['coupon'];
            if($coupon == 'true'){
                $courses = $course->where('sale_price','!=',null)->where('date_on_sale_from', '<' ,Carbon::now())->where('date_on_sale_to', '>' ,Carbon::now())->paginate(12);
            }
        }
        else if(!empty($_GET['popular'])){
            $popular = $_GET['popular'];
            if($popular == 'true'){
            // withCount('orders')
            $courses = $course->withCount('order_items')->paginate(12);
            }
        }
        else{
            $courses = $course->where('is_active' , 1)->paginate(12);
        }
        return view('home.courses.all-course' , compact('courses'));
    }
    public function show(Request $request , Category $category){
        $this->SEOToolsMethods();
        $attributes = $category->attributes()->where('is_filter' , 1)->with('values')->get();
        // $variation = $category->attributes()->where('is_variation' , 1)->with('variationValues')->first();
        // $courses = $category->courses()->where('quantity' , '!=' , 0)->filter()->get();
        $courses = $category->courses()->filter()->search()->paginate(12);
        return view('home.categories.show' , compact('category' , 'attributes' , 'courses'));
    }
    public function SEOToolsMethods()
    {
        SEOTools::setTitle('Hamrah Software');
        SEOTools::setDescription('در خانه بیاموزید');
        SEOTools::setCanonical('https://hamrahsoftware.ir/courses/all');
        SEOTools::opengraph()->setUrl('http://hamrahsoftware.ir');
        SEOTools::opengraph()->setDescription('Hamrah Software');
        // SEOTools::opengraph()->addProperty('description', 'articles');
        SEOTools::twitter()->setSite('@HamrahSoftware');
        SEOTools::jsonLd()->addImage('/img/MainLogo2.png');
    }
}
