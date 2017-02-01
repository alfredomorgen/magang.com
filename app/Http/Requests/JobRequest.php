<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'job_category_id' => 'required',
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
