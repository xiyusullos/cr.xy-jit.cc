<?php

namespace App\Http\Requests;

use App\Entities\Classroom;
use App\Entities\Reservation;
use App\Exceptions\ForbiddenException;
use App\Exceptions\JWTTokenException;

class ReservationCreateRequest extends WithJWTTokenRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     * @throws ForbiddenException
     * @throws JWTTokenException
     */
    public function authorize()
    {
        // check whether there are classrooms available between `begin_time`
        // and `end_time`
        // whether the classroom is reserved between `begin_time` and `end_time`
        $reservation = Reservation::where('classroom_id', $this->request->get('classroom_id'))
            ->where(function ($q) {
                $betweenTimes = [
                    $this->request->get('begin_time'),
                    $this->request->get('end_time')
                ];
                $q->whereBetween('begin_time', $betweenTimes)
                    ->orWhereBetween('end_time', $betweenTimes)
                ;
            })->first();
        if ($reservation) {
            throw new ForbiddenException('该教室此时间段内不可被租赁');
        }

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
            'begin_time' => 'required',
            'end_time' => 'required',
        ];
    }
}
