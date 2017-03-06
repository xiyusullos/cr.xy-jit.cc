<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Reservation;

/**
 * Class ReservationTransformer
 * @package namespace App\Transformers;
 */
class ReservationTransformer extends TransformerAbstract
{

    /**
     * Transform the \Reservation entity
     * @param \Reservation $model
     *
     * @return array
     */
    public function transform(Reservation $model)
    {
        return [
            'id'         => (int) $model->id,

            'user_id' =>  $model->user_id,
            'classroom_id' =>  $model->classroom_id,
            'begin_time' =>  $model->begin_time,
            'end_time' =>  $model->end_time,

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    protected $defaultIncludes = ['classroom'];

    public function includeClassroom(Reservation $model)
    {
        return $this->item($model->classroom, new ClassroomTransformer,
            'classroom');
    }
}
