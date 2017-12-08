<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

class UserSettingsUpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = Auth::user()->id;
        return $rules = [
            'login' => 'required|max:255|unique:users,login,' . $id,
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'sex' => 'required',
            'password' => 'nullable|min:6|confirmed'
        ];
    }
}
