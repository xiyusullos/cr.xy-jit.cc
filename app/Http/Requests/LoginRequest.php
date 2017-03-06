<?php

namespace App\Http\Requests;

use App\Exceptions\ForbiddenException;

/**
 * Class LoginRequest
 * @package App\Http\Requests
 */
class LoginRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     * @throws ForbiddenException
     */
    public function authorize()
    {
        $token = \JWTAuth::attempt([
            'email' => $this->request->get('email'),
            'password' => $this->request->get('password'),
        ]);
        if (is_null($token)) {
            throw new ForbiddenException('账号或密码错误');
        }
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
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ];
    }
}
