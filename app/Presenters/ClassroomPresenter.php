<?php

namespace App\Presenters;

use App\Transformers\ClassroomTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ClassroomPresenter
 *
 * @package namespace App\Presenters;
 */
class ClassroomPresenter extends FractalPresenter
{
    protected $resourceKeyItem = 'classroom';
    protected $resourceKeyCollection = 'classrooms';

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ClassroomTransformer();
    }
}
