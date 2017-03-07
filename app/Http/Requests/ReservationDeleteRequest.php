<?php

namespace App\Http\Requests;

use App\Entities\Reservation;
use App\Exceptions\JWTTokenException;
use Illuminate\Foundation\Http\FormRequest;

class ReservationDeleteRequest extends BaseRequest
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
            $reservation = Reservation::find($this->id);
            if ($user->id == $reservation->user_id) {
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
