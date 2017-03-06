<?php

namespace App\Http\Requests;

use App\Entities\Code;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $code = Code::where('email', $this->request->get('email'))
            ->where('code', $this->request->get('code'))
            ->orderBy('created_at', 'desc')
            ->first();
        try {
            if (Carbon::now()->diffInSeconds($code->created_at) <=
            $code->expiration) {
                $code->delete();
                return true;
            }
            throw new ForbiddenException('验证码失效');
        } catch (\Exception $e) {
            throw new ForbiddenException('验证码错误或已被使用');
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'code' => 'required',
        ];
    }
}
