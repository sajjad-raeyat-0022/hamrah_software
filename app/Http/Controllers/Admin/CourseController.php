<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Course;
use App\Models\Category;
use App\Models\CourseMovie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CourseMovieController;
use App\Http\Controllers\Admin\CourseAttributeController;
use App\Http\Controllers\Admin\CourseVariationController;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller
{
    //  /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        $courses = course::latest()->paginate(10);
        return view('admin.courses.index' , compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        $tags = Tag::all();
        $categories = Category::where('parent_id' , '!=' , 0)->get();
        return view('admin.courses.create' , compact('tags' , 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        // dd($request->course->tags());

        $request->validate([
            'name' => 'required',
            'is_active' => 'required',
            'description' => 'required',
            'primary_image' => 'required|mimes:jpg,jpeg,png,svg',
            'primary_video' => 'required|mimes:mp4',
            'category_id' => 'required',
            'attribute_ids' => 'required',
            'attribute_ids.*' => 'required',
            'price' => 'integer',
            'slug' => 'required',
            'movie_download_link' => 'required',
            'movie_download_link.*' => 'mimes:mp4',
            'delivery_amount' => 'required|integer',
        ]);



        try {
            DB::beginTransaction();

            $courseMovieController = new CourseMovieController();
            $fileNameImages = $courseMovieController->upload($request->primary_image , $request->movie_download_link);

            $fileNamePrimaryVideo = generateFileName($request->primary_video->getClientOriginalName());
            $request->primary_video->move(public_path(env('EDU_COURSE_MOVIES_UPLOAD_PATH')), $fileNamePrimaryVideo);

            $course = course::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'category_id' => $request->category_id,
                'primary_image' => $fileNameImages['fileNamePrimaryImage'],
                'primary_video' => $fileNamePrimaryVideo,
                'description' => $request->description,
                'is_active' => $request->is_active,
                'delivery_amount' => $request->delivery_amount,
                'price' => $request->price,
            ]);

            foreach($fileNameImages['fileNameMovies'] as $key => $fileNameMovie){
                courseMovie::create([
                    'course_id' => $course->id,
                    'movie_download_link' => $fileNameMovie,
                    'movie_name' => $request->movie_name[$key],
                    // 'movie_price' => $request->movie_price[$key],
                ]);
            }

            $courseAttributeController = new courseAttributeController();
            $courseAttributeController->store($request->attribute_ids , $course);

            $course->tags()->attach($request->tag_ids);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            alert()->error('مشکل در ایجاد دوره آموزشی' , $ex->getMessage())->persistent('باشه');
            return redirect()->back();
        }

        alert()->success('دوره آموزشی مورد نظر به درستی ایجاد شد' , 'با تشکر');
        return redirect()->route('admin.courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(course $course)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        $courseAttributes = $course->attributes()->with('attribute')->get();
        $movies = $course->download_movie;
        return view('admin.courses.show' , compact('course' , 'courseAttributes' , 'movies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(course $course)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        $tags = Tag::all();
        $courseAttributes = $course->attributes()->with('attribute')->get();
        $movies = $course->download_movie;
        return view('admin.courses.edit' , compact('movies' , 'courseAttributes' , 'course' , 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, course $course)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'is_active' => 'required',
            'tag_ids' => 'required',
            'tag_ids.*' => 'exists:tags,id',
            'description' => 'required',
            'attribute_values' => 'required',
            'price' => 'required|integer',
            'sale_price' => 'nullable|integer',
            'date_on_sale_from' => 'nullable|date',
            'date_on_sale_to' => 'nullable|date',
            'delivery_amount' => 'required|integer',
        ]);

        try {
            DB::beginTransaction();

            $course->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
                'is_active' => $request->is_active,
                'delivery_amount' => $request->delivery_amount,
                'price' => $request->price,
                'sale_price' => $request->sale_price,
                'date_on_sale_from' => convertShamsiToGregorianDate($request->date_on_sale_from),
                'date_on_sale_to' => convertShamsiToGregorianDate($request->date_on_sale_to),
            ]);

            $courseAttributeController = new courseAttributeController();
            $courseAttributeController->update($request->attribute_values);

            $course->tags()->sync($request->tag_ids);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            alert()->error('مشکل در ویرایش دوره آموزشی' , $ex->getMessage())->persistent('باشه');
            return redirect()->back();
        }

        alert()->success('دوره آموزشی مورد نظر به درستی ویرایش شد' , 'با تشکر');
        return redirect()->route('admin.courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function editCategory(Request $request , course $course)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        $categories = Category::where('parent_id' , '!=' , 0)->get();
        return view('admin.courses.edit_category' , compact('course' , 'categories'));
    }

    public function updateCategory(Request $request , course $course)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        $request->validate([
            'category_id' => 'required',
            'attribute_ids' => 'required',
            'attribute_ids.*' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $course->update([
                'category_id' => $request->category_id,
            ]);

            $courseAttributeController = new courseAttributeController();
            $courseAttributeController->change($request->attribute_ids , $course);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            alert()->error('مشکل در ویرایش دسته بندی دوره آموزشی' , $ex->getMessage())->persistent('باشه');
            return redirect()->back();
        }

        alert()->success('دسته بندی دوره آموزشی مورد نظر به درستی ویرایش شد' , 'با تشکر');
        return redirect()->route('admin.courses.index');
    }
}
