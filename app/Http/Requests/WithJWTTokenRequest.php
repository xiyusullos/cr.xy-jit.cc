<?php

namespace App\Http\Requests;

use App\Exceptions\JWTTokenException;

class WithJWTTokenRequest extends BaseRequest
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
            //
        ];
    }
}
