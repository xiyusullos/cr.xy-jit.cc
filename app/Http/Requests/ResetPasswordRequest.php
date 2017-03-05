<?php

namespace App\Http\Requests;

use App\Entities\Code;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ResetPasswordRequest
 * @package App\Http\Requests
 */
class ResetPasswordRequest extends FormRequest
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
                // $code->delete();
                return true;
            }

            return false;
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
            'email'     => 'required|exists:users,email',
            'code'      => 'required',
            'password' => 'required',
        ];
    }
}
