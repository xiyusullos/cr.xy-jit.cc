<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\User;

/**
 * Class UserTransformer
 * @package namespace App\Transformers;
 */
class UserTransformer extends TransformerAbstract
{

    /**
     * Transform the \User entity
     * @param \User $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id'         => (int) $model->id,

            'name' => $model->name,
            'email' => $model->email,

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,

            'token' => $model->token,
        ];
    }
}
