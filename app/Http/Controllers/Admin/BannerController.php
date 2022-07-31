<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BannerController extends Controller
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
        $banners = Banner::latest()->paginate(10);
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        return view('admin.banners.create');
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
        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png,svg',
            'priority' => 'required|integer',
            'type' => 'required'
        ]);

        $fileNameImage = generateFileName($request->image->getClientOriginalName());
        $request->image->move(public_path(env('BANNER_IMAGES_UPLOAD_PATH')), $fileNameImage);

        Banner::create([
            'image' => $fileNameImage,
            'title' => $request->title,
            'text' => $request->text,
            'priority' => $request->priority,
            'is_active' => $request->is_active,
            'type' => $request->type,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'button_icon' => $request->button_icon,
        ]);

        alert()->success('بنر مورد نظر ایجاد شد', 'باتشکر');
        return redirect()->route('admin.banners.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        return view('admin.banners.show' , compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        $request->validate([
            'image' => 'nullable|mimes:jpg,jpeg,png,svg',
            'priority' => 'required|integer',
            'type' => 'required'
        ]);

        if ($request->has('image')) {
            $fileNameImage = generateFileName($request->image->getClientOriginalName());
            $request->image->move(public_path(env('BANNER_IMAGES_UPLOAD_PATH')), $fileNameImage);
        }

        $banner->update([
            'image' => $request->has('image') ? $fileNameImage : $banner->image,
            'title' => $request->title,
            'text' => $request->text,
            'priority' => $request->priority,
            'is_active' => $request->is_active,
            'type' => $request->type,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'button_icon' => $request->button_icon,
        ]);

        alert()->success('بنر مورد نظر ویرایش شد', 'باتشکر');
        return redirect()->route('admin.banners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        $banner->delete();

        alert()->success('بنر مورد نظر حذف شد', 'باتشکر');
        return redirect()->route('admin.banners.index');
    }
}
