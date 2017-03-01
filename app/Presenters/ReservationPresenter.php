<?php

namespace App\Presenters;

use App\Transformers\ReservationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ReservationPresenter
 *
 * @package namespace App\Presenters;
 */
class ReservationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ReservationTransformer();
    }
}
