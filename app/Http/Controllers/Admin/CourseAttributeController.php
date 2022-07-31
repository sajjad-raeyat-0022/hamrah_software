<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CourseAttributeController extends Controller
{
    //     /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function store($attributes, $course)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        foreach ($attributes as $key => $value) {
            courseAttribute::create([
                'course_id' => $course->id,
                'attribute_id' => $key,
                'value' => $value
            ]);
        }
    }

    public function update($attributeIds)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        foreach ($attributeIds as $key => $value) {
            $courseAttibute = courseAttribute::findOrFail($key);
            $courseAttibute->update([
                'value' => $value
            ]);
        }
    }
    public function change($attributes , $course)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        CourseAttribute::where('course_id' , $course->id)->delete();

        foreach ($attributes as $key => $value) {
            courseAttribute::create([
                'course_id' => $course->id,
                'attribute_id' => $key,
                'value' => $value
            ]);
        }
    }
}
