<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attribute;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AttributeController extends Controller
{

    // /**
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
        $attributes = Attribute::latest()->paginate(10);
        return view('admin.attributes.index' , compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        return view('admin.attributes.create');
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

        Attribute::create([
            'name' => $request->name
        ]);

        alert()->success('ویژگی مورد نظر ایجاد شد', 'باتشکر');
        return redirect()->route('admin.attributes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Attribute $attribute)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        return view('admin.attributes.show' , compact('attribute'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        return view('admin.attributes.edit' , compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        $request->validate([
            'name' => 'required'
        ]);

        $attribute->update([
            'name' => $request->name
        ]);

        alert()->success('ویژگی مورد نظر ویرایش شد', 'باتشکر');
        return redirect()->route('admin.attributes.index');
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
