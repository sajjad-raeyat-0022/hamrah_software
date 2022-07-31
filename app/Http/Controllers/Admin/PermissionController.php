<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    public function index()
    {
        $permissions = Permission::latest()->paginate(10);
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'display_name' => 'required',
        ]);

        Permission::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'guard_name' => 'web',
        ]);

        alert()->success('مجوز مورد نظر ایجاد شد', 'باتشکر');
        return redirect()->route('admin.permissions.index');

    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required',
            'display_name' => 'required'
        ]);

        $permission->update([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);

        alert()->success('مجوز مورد نظر ویرایش شد', 'باتشکر');
        return redirect()->route('admin.permissions.index');
    }
}
