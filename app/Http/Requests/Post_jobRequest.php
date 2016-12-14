<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Post_jobRequest extends Request
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
            'name' => 'required',
            'job_category_id' => 'required|in:0,1,2,3,',
            'location' => 'required',
            'type' => 'required',
            'salary' => 'required|in:0,1',
            'period' => 'required',
            'benefit' => '',
            'requirement' => 'required',
            'description' => 'required',
        ];
    }
}
