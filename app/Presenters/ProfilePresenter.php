<?php

namespace App\Presenters;

use App\Transformers\ProfileTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProfilePresenter
 *
 * @package namespace App\Presenters;
 */
class ProfilePresenter extends FractalPresenter
{
    protected $resourceKeyItem = 'profile';
    protected $resourceKeyCollection = 'profiles';

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProfileTransformer();
    }
}
