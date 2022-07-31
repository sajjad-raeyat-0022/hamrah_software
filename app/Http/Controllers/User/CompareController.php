<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function add(Course $course)
    {
         if (auth()->check()) {
            if (session()->has('compareCourses' .'-' .auth()->id())) {
                $c = count(Course::findOrFail(session()->get('compareCourses' .'-' .auth()->id())));
                if($c == 4){
                    alert()->warning('شما فقط میتوانید 4 دوره را برای مقایسه اضاف کنید', 'دقت کنید');
                    return redirect()->back();
                }
                else if (in_array($course->id, session()->get('compareCourses' .'-' .auth()->id()))) {
                    alert()->warning('دوره مورد نظر از قبل در لیست مقایسه دوره وجود دارد', 'دقت کنید');
                    return redirect()->back();
                }
                session()->push('compareCourses' .'-' .auth()->id(), $course->id);
            } else {
                session()->put('compareCourses' .'-' .auth()->id(), [$course->id]);
            }

            alert()->success('دوره مورد نظر به لیست مقایسه دوره اضافه شد', 'باتشکر');
            return redirect()->back();
        }else{
            alert()->warning('برای افزودن به لیست مقایسه دوره ها نیاز است ابتدا وارد سایت شوید', 'دقت کنید')->persistent('باشه');
            return redirect()->back();
        }
    }

    public function index()
    {
        if (session()->has('compareCourses' .'-' .auth()->id())) {

            $courses = Course::findOrFail(session()->get('compareCourses' .'-' .auth()->id()));

            return view('user.users_profile.compare', compact('courses'));
        }

        return view('user.users_profile.compare');
    }

    public function remove($courseid)
    {
        if (session()->has('compareCourses' .'-' .auth()->id())) {
            foreach (session()->get('compareCourses' .'-' .auth()->id()) as $key => $item) {
                if ($item == $courseid) {
                    session()->pull('compareCourses' .'-' .auth()->id() .'.' . $key);
                }
            }
            if (session()->get('compareCourses' .'-' .auth()->id()) == []) {
                session()->forget('compareCourses' .'-' .auth()->id());
                alert()->success('دوره مورد نظر از لیست مقایسه دوره حذف شد', 'باتشکر');
                return redirect()->route('user.users_profile.compare');
            }
            alert()->success('دوره مورد نظر از لیست مقایسه دوره حذف شد', 'باتشکر');
            return redirect()->route('user.users_profile.compare');
        }

        return view('user.users_profile.compare');
    }
}
