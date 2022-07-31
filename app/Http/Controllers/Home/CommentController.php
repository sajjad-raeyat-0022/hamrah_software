<?php

namespace App\Http\Controllers\Home;

use App\Models\Course;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\CourseRate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request , Course $course)
    {
        // dd($request->all());

        // $request->validate([
        //     'text' => 'required',
        // ]);

        $validator = Validator::make($request->all() , [
            'text' => 'required|min:5|max:7000',
            'rate' => 'required|digits_between:0,5',
        ]);

        if($validator->fails()){
            return redirect()->to(url()->previous() .'#comments')->withErrors($validator);
        }

        if(auth()->check()){
            try {
                DB::beginTransaction();

                Comment::create([
                    'user_id' => auth()->id(),
                    'course_id' => $course->id,
                    'text' => $request->text,
                ]);

                if($course->rates()->where('user_id' , auth()->id())->exists()){
                    $courseRate = $course->rates()->where('user_id' , auth()->id())->first();
                    $courseRate->update([
                        'rate' => $request->rate,
                    ]);
                }else{
                    CourseRate::create([
                        'user_id' => auth()->id(),
                        'course_id' => $course->id,
                        'rate' => $request->rate,
                    ]);
                }

                DB::commit();
            } catch (\Exception $ex) {
                DB::rollback();
                alert()->error('مشکل در ایجاد دیدگاه' , $ex->getMessage())->persistent('باشه');

            }
            alert()->success('دیدگاه ارزشمند شما با موفقیت برای این دوره ثبت شد' , 'با تشکر');
            return redirect()->back();
        }else{
            alert()->warning('برای ثبت دیدگاه نیاز است ابتدا وارد سایت شوید' , 'دقت کنید')->persistent('باشه');
            return redirect()->back();
        }
    }

    public function usersProfileIndex()
    {
        $comments = Comment::where('user_id' , auth()->id())->where('approved' , 1)->get();
        return view('user.users_profile.comments' , compact('comments'));
    }
}
