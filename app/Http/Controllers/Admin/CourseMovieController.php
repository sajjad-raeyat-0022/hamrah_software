<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseMovie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CourseMovieController extends Controller
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

    public function upload($image, $movie_download_link)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');

        $fileNameImage = generateFileName($image->getClientOriginalName());

        $image->move(public_path(env('EDU_COURSE_IMAGE_UPLOAD_PATH')), $fileNameImage);

        $fileNamemovie_download_link = [];
        foreach ($movie_download_link as $movie) {
            $fileNameMovie = generateFileName($movie->getClientOriginalName());

            $movie->move(public_path(env('EDU_COURSE_MOVIES_UPLOAD_PATH')), $fileNameMovie);

            array_push($fileNamemovie_download_link,  $fileNameMovie);
        }


        return ['fileNamePrimaryImage' => $fileNameImage, 'fileNameMovies' => $fileNamemovie_download_link];
    }
    public function edit(Course $course)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        $movies = $course->download_movie;
        return view('admin.courses.edit_movies', compact('course', 'movies'));
    }

    public function destroy(Request $request)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        $request->validate([
            'movie_id' => 'required|exists:course_movies,id'
        ]);

        CourseMovie::destroy($request->movie_id);

        alert()->success('ویدئو دوره مورد نظر حدف شد', 'باتشکر');
        return redirect()->back();
    }

    public function set(Request $request, Course $course)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        // dd($request->all());
        $request->validate([
            'primary_image' => 'nullable|mimes:jpg,jpeg,png,svg',
        ]);
        if ($request->primary_image == null) {
            return redirect()->back()->withErrors(['msg' => 'تصویر اصلی دوره آموزشی الزامی هست']);
        }

        try {
            DB::beginTransaction();

            if ($request->has('primary_image')) {

                $fileNamePrimaryImage = generateFileName($request->primary_image->getClientOriginalName());
                $request->primary_image->move(public_path(env('EDU_COURSE_IMAGE_UPLOAD_PATH')), $fileNamePrimaryImage);

                $course->update([
                    'primary_image' => $fileNamePrimaryImage
                ]);
            }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            alert()->error('مشکل در ویرایش تصویر اصلی دوره', $ex->getMessage())->persistent('حله');
            return redirect()->back();
        }
        alert()->success('ویرایش تصویر اصلی دوره با موفقیت انجام شد', 'باتشکر');
        return redirect()->back();
    }

    public function add(Request $request, Course $course)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        $request->validate([
            'movies_download_link.*' => 'nullable|mimes:mp4',
        ]);

        if ($request->movie_download_link == null) {
            return redirect()->back()->withErrors(['msg' => 'اضافه کردن ویدئو دوره الزامی هست']);
        }

        try {
            DB::beginTransaction();

            if ($request->has('movie_download_link')) {

                foreach ($request->movie_download_link as $key => $movie) {
                    $fileNameMovie = generateFileName($movie->getClientOriginalName());

                    $movie->move(public_path(env('EDU_COURSE_MOVIES_UPLOAD_PATH')), $fileNameMovie);

                    CourseMovie::create([
                        'course_id' => $course->id,
                        'movie_name' => $request->movie_name[$key],
                        // 'movie_price' => $request->movie_price[$key],
                        'movie_download_link' => $fileNameMovie
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            alert()->error('مشکل در ایجاد ویدئو دوره', $ex->getMessage())->persistent('حله');
            return redirect()->back();
        }

        alert()->success('ویرایش ویدئو دوره با موفقیت انجام شد', 'باتشکر');
        return redirect()->back();
    }
    public function set_primary_video(Request $request, Course $course)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        // dd($request->all());
        $request->validate([
            'primary_video' => 'nullable|mimes:mp4',
        ]);

        if ($request->primary_video == null) {
            return redirect()->back()->withErrors(['msg' => 'ویدئو پیش نمایش دوره آموزشی الزامی هست']);
        }

        try {
            DB::beginTransaction();

            if ($request->has('primary_video')) {

                $fileNamePrimaryVideo = generateFileName($request->primary_video->getClientOriginalName());
                $request->primary_video->move(public_path(env('EDU_COURSE_MOVIES_UPLOAD_PATH')), $fileNamePrimaryVideo);

                $course->update([
                    'primary_video' => $fileNamePrimaryVideo
                ]);
            }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            alert()->error('مشکل در ویرایش تصویر اصلی دوره', $ex->getMessage())->persistent('حله');
            return redirect()->back();
        }
        alert()->success('ویرایش تصویر اصلی دوره با موفقیت انجام شد', 'باتشکر');
        return redirect()->back();
    }
}
