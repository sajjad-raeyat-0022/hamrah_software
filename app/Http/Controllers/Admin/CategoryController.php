<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
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
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        $parentCategories = Category::where('parent_id' , 0)->get();
        $attributes = Attribute::all();
        return view('admin.categories.create' , compact('parentCategories', 'attributes'));
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
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
            'parent_id' => 'required',
            'attribute_ids' => 'required',
            'attribute_ids.*' => 'exists:attributes,id',
            'attribute_is_filter_ids' => 'required',
            'attribute_is_filter_ids.*' => 'exists:attributes,id',
            // 'variation_id' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $category = Category::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'parent_id' => $request->parent_id,
                'icon' => $request->icon,
                'description' => $request->description,
                'is_active' =>$request->is_active,
            ]);

            foreach($request->attribute_ids as $attributeId){
                $attribute = Attribute::findOrFail($attributeId);
                $attribute->categories()->attach($category->id , [
                    'is_filter' => in_array($attributeId , $request->attribute_is_filter_ids) ? 1 : 0,
                    // 'is_variation' => $request->variation_id == $attributeId ? 1 : 0,
                ]);
            }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            alert()->error('مشکل در ایجاد دسته بندی' , $ex->getMessage())->persistent('باشه');
            return redirect()->back();
        }

        alert()->success('دسته بندی مورد نظر به درستی ایجاد شد' , 'با تشکر');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        $parentCategories = Category::where('parent_id', 0)->get();
        $attributes = Attribute::all();
        return view('admin.categories.edit', compact('category', 'parentCategories', 'attributes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' .$category->id,
            'parent_id' => 'required',
            'attribute_ids' => 'required',
            'attribute_ids.*' => 'exists:attributes,id',
            'attribute_is_filter_ids' => 'required',
            'attribute_is_filter_ids.*' => 'exists:attributes,id',
        ]);

        try {
            DB::beginTransaction();

            $category->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'parent_id' => $request->parent_id,
                'icon' => $request->icon,
                'description' => $request->description,
                'is_active' =>$request->is_active,
            ]);

            $category->attributes()->detach();

            foreach($request->attribute_ids as $attributeId){
                $attribute = Attribute::findOrFail($attributeId);
                $attribute->categories()->attach($category->id , [
                    'is_filter' => in_array($attributeId , $request->attribute_is_filter_ids) ? 1 : 0,
                ]);
            }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            alert()->error('مشکل در ویرایش دسته بندی' , $ex->getMessage())->persistent('باشه');
            return redirect()->back();
        }

        alert()->success('دسته بندی مورد نظر به درستی ویرایش شد' , 'با تشکر');
        return redirect()->route('admin.categories.index');
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
    public function getCategoryAttributes(Category $category)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        $attributes = $category->attributes()->wherePivot('is_variation',0)->get();
        $variation = $category->attributes()->wherePivot('is_variation',1)->first();
        return ['attributes' => $attributes , 'variation' => $variation];
    }
}
