<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function index()
    {
        return view('user.users_profile.index');
    }
    public function updateUser(Request $request)
    {
        $user = User::where('id', auth()->id());
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'nullable',
            'phone_number' => 'nullable|ir_mobile',
            'avatar' => 'nullable|mimes:jpg,jpeg,png,svg',
        ]);

         if ($request->has('name')) {
                $user->update([
                    'name' => $request->name,
                ]);
        }
        if ($request->has('profile_avatar')) {

            $fileNameProfileImage = generateFileName($request->profile_avatar->getClientOriginalName());
            $request->profile_avatar->move(public_path(env('PROFILE_IMAGE_UPLOAD_PATH')), $fileNameProfileImage);

            $user->update([
                'avatar' => '/upload/files/Profile/images/' . $fileNameProfileImage,
            ]);
        }
        if ($request->has('email') && $request->email != null) {
            if (!(User::where('email', $request->email)->first())) {
                $user->update([
                    'email' => $request->email,
                ]);
            } else {
                alert()->warning('ایمیل وارد شده از قبل وجود دارد', 'دقت کنید')->persistent('باشه');
                return redirect()->route('user.users_profile.index');
            }
        }
        if ($request->has('phone_number')) {
            if (!(User::where('phone_number', $request->phone_number)->first())) {
                $user->update([
                    'phone_number' => $request->phone_number,
                ]);
            } else {
                alert()->warning('شماره تلفن وارد شده از قبل وجود دارد', 'دقت کنید')->persistent('باشه');
                return redirect()->route('user.users_profile.index');
            }
        }
       

        alert()->success('اطلاعات کاربری با موفقیت ویرایش شد', 'باتشکر');
        return redirect()->route('user.users_profile.index');
    }
}
