<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomCreateRequest extends FormRequest
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
            'number' => 'required|unique:classrooms,number',
            'name' => 'required',
            'location' => 'required',
            'square' => 'required',
            'floor' => 'required',
            'is_free' => 'required',
            'building_name' => 'required',
        ];
    }
}
