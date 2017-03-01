<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Reservation;

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

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
