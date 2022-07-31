<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Favoritelist;
use Illuminate\Http\Request;

class FavoritelistController extends Controller
{
    public function add(Course $course)
    {
        if (auth()->check()) {
            if ($course->checkUserFavoritelist(auth()->id())) {
                alert()->warning('دوره از قبل در لیست علاقه مندی های شما وجود دارد', 'دقت کنید')->persistent('باشه');
                return redirect()->back();
            } else {
                Favoritelist::create([
                    'user_id' => auth()->id(),
                    'course_id' => $course->id,
                ]);
                alert()->success('این دوره با موفقیت به لیست علاقه مندی های شما اضاف شد', 'با تشکر');
                return redirect()->back();
            }
        } else {
            alert()->warning('برای افزودن به لیست علاقه مندی ها نیاز است ابتدا وارد سایت شوید', 'دقت کنید')->persistent('باشه');
            return redirect()->back();
        }
    }
    public function remove(Course $course)
    {
        if (auth()->check()) {
            $favoritelist = Favoritelist::where('course_id',$course->id)->where('user_id',auth()->id())->firstOrFail();
            if($favoritelist){
                Favoritelist::where('course_id',$course->id)->where('user_id',auth()->id())->delete();
            }
            alert()->success('این دوره از لیست علاقه مندی های شما حذف شد', 'با تشکر');
             return redirect()->back();
        } else {
            alert()->warning('برای حذف از لیست علاقه مندی ها نیاز است ابتدا وارد سایت شوید', 'دقت کنید')->persistent('باشه');
            return redirect()->back();
        }
    }
    public function usersFavoritelist()
    {
        $favoritelist = Favoritelist::where('user_id',auth()->id())->get();
        return view('user.users_profile.favoritelist',compact('favoritelist'));
    }
}
