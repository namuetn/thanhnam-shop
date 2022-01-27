<?php

namespace App\Http\Requests\Backend;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'oldpassword' => [
                'required', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Admin::find(1)->password)) {
                        $fail('Old Password do not match');
                    }
                },
            ],
            'password' => 'required|confirmed|min:6',
        ];
    }
}
