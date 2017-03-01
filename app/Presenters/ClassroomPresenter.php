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
    public function __construct()
    {
        parent::__construct();
        $this->resourceKeyItem = 'classroom';
        $this->resourceKeyCollection = 'classrooms';
    }

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
