<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontEnd\UserProfileUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IndexController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function userLogout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function userProfile()
    {
        $user = User::findOrFail(auth()->id());

        return view('frontend.profile.user_profile', compact('user'));
    }

    public function userProfileUpdate(UserProfileUpdateRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = User::findOrFail(auth()->id());
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;

            if ($request->file('profile_photo_path')) {
                $file = $request->file('profile_photo_path');
                !is_null($data->profile_photo_path) ? @unlink(public_path('upload/user_images/' . $data->profile_photo_path)) : '';
                $filename = date('YmdHi') . '.' . $file->getClientOriginalName();
                $file->move(public_path('upload/user_images/'), $filename);
                $data['profile_photo_path'] = $filename;
            }

            $data->save();
            $notification = [
                'message' => 'User Profile Updated Successfully',
                'alert-type' => 'success',
            ];

            DB::commit();

            return redirect()->route('dashboard')->with($notification);
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();

            return redirect()->back();
        }
    }
}
