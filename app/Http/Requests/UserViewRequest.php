<?php

namespace App\Http\Requests;

use App\Exceptions\JWTTokenException;
use Illuminate\Foundation\Http\FormRequest;

class UserViewRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     * @throws JWTTokenException
     */
    public function authorize()
    {
        dd($this->request->get('user_id'));
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
            'user_id' => 'required|exists:users,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'begin_time' => 'required,'
        ];
    }
}
