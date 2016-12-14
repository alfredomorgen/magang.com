<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserRequest extends Request
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
//            'name',
//            'email',
//            'password',
//            'phone',
//            'description',
//            'role',
            'photo' => 'mimes:jpeg,bmp,png,jpg|max:5000',
            'resume' => 'mimes:pdf|max:15360'
        ];
    }
}
