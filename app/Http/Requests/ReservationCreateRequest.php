<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        try {
            $user = \JWTAuth::parseToken()->authenticate();
            return $user->id == request()->input('user_id');
        } catch (\Exception $e) {
            return false;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|exists:admin_users,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'begin_time' => 'required',
            'end_time' => 'required',
        ];
    }
}
