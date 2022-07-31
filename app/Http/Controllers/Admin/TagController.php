<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TagController extends Controller
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

        $tags = Tag::latest()->paginate(10);
        return view('admin.tags.index' , compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');

        return view('admin.tags.create');
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
            'name' => 'required'
        ]);

        Tag::create([
            'name' => $request->name
        ]);

        alert()->success('تگ مورد نظر ایجاد شد', 'باتشکر');
        return redirect()->route('admin.tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        return view('admin.tags.show' , compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        return view('admin.tags.edit' , compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        $request->validate([
            'name' => 'required'
        ]);

        $tag->update([
            'name' => $request->name
        ]);

        alert()->success('تگ مورد نظر ویرایش شد', 'باتشکر');
        return redirect()->route('admin.tags.index');
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
}
