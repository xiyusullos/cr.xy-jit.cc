<?php

namespace App\Presenters;

use App\Transformers\AuthenticateTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AuthenticatePresenter
 *
 * @package namespace App\Presenters;
 */
class AuthenticatePresenter extends FractalPresenter
{
    protected $resourceKeyItem = 'user';
    protected $resourceKeyCollection = 'users';
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AuthenticateTransformer();
    }
}
