<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Order;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function show(Course $course){
        $courses = $course->where('is_active' , 1)->get()->take(10);
        $orders = Order::where('user_id', auth()->id())->where('payment_status',1)->get();
        // dd($orders);
        return view('home.courses.show' , compact('course' , 'courses','orders'));
    }
}
