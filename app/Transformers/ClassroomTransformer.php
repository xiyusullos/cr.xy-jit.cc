<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Classroom;

/**
 * Class ClassroomTransformer
 * @package namespace App\Transformers;
 */
class ClassroomTransformer extends TransformerAbstract
{

    /**
     * Transform the \Classroom entity
     * @param \Classroom $model
     *
     * @return array
     */
    public function transform(Classroom $model)
    {
        return [
            'id'         => (int) $model->id,

            'number' => $model->number,
            'name' => $model->name,
            'location' => $model->location,
            'square' => $model->square,
            'floor' => $model->floor,
            'is_free' => $model->is_free,
            'building_name' => $model->building_name,

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
