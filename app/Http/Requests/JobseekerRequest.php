<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class JobseekerRequest extends Request
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
            'password' => 'confirmed',
            'phone' => 'numeric',
            'photo' => 'image|max:5000',
            'resume' => 'mimes:pdf|max:15360'
        ];
    }
}
