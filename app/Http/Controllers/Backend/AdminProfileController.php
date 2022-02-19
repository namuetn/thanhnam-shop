<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminProfileRequest;
use App\Http\Requests\Backend\AdminUpdatePasswordRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminProfileController extends Controller
{
    public function adminProfile()
    {
        $adminData = Admin::findOrFail(1);

        return view('admin.admin_profile', compact('adminData'));
    }

    public function adminProfileEdit()
    {
        $adminData = Admin::findOrFail(1);

        return view('admin.admin_profile_edit', compact('adminData'));
    }

    public function adminProfileStore(AdminProfileRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = Admin::findOrFail(1);
            $data->name = $request->name;
            $data->email = $request->email;

            if ($request->file('profile_photo_path')) {
                $file = $request->file('profile_photo_path');
                !is_null($data->profile_photo_path) ? @unlink(public_path('upload/admin_images/' . $data->profile_photo_path)) : '';
                $filename = date('YmdHi') . '.' . $file->getClientOriginalName();
                $file->move(public_path('upload/admin_images/'), $filename);
                $data['profile_photo_path'] = $filename;
            }

            $data->save();
            $notification = [
                'message' => 'Admin Profile Updated Successfully',
                'alert-type' => 'success',
            ];

            DB::commit();

            return redirect()->route('admin.profile')->with($notification);
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();

            return redirect()->back();
        }
    }

    public function adminChangePassword()
    {
        return view('admin.admin_change_password');
    }

    public function adminUpdatePassword(AdminUpdatePasswordRequest $request)
    {
        $hashedPassword = Admin::find(1)->password;

        if (Hash::check($request->oldpassword, $hashedPassword)) {
            Admin::find(1)->update([
                'password' => Hash::make($request->password),
            ]);

            Auth::logout();

            return redirect()->route('admin.logout');
        }

        return redirect()->back()->with([
            'message' => 'Admin Updated Password Failure',
            'alert-type' => 'error',
        ]);
    }
}
