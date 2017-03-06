<?php

namespace App\Http\Requests;

use App\Exceptions\InvalidCredentialException;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        $token = \JWTAuth::attempt(['email' => $this->request->get('email'),
            'password' => $this->request->get('password'),]);
        return (bool) $token;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ];
    }

    public function forbiddenResponse()
    {
        throw new InvalidCredentialException('账号或密码错误');
    }
}
