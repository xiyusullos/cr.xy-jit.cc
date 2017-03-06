<?php

namespace App\Http\Requests;

use App\Exceptions\JWTTokenException;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            if ($user->id == $this->id) {
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
            'name' => '',
            'username' => 'email|unique:users,email,'.$this->id.',id',
            'password' => '',
        ];
    }
}
