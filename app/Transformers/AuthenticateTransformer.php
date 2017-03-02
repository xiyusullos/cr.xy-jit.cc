<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Authenticate;

/**
 * Class AuthenticateTransformer
 * @package namespace App\Transformers;
 */
class AuthenticateTransformer extends TransformerAbstract
{

    /**
     * Transform the \Authenticate entity
     * @param \Authenticate $model
     *
     * @return array
     */
    public function transform(Authenticate $model)
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
