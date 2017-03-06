<?php

namespace App\Http\Requests;

use App\Exceptions\JWTTokenException;

class ReservationCreateRequest extends WithJWTTokenRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     * @throws JWTTokenException
     */
    public function authorize()
    {
        try {
            $user = \JWTAuth::parseToken()->authenticate();
            if ($user->id == $this->request->get('user_id')) {
                return true;
            }
            throw new JWTTokenException("token错误");
        } catch (\Exception $e) {
            throw new JWTTokenException("token错误");
        }
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
