<?php

namespace App\Repositories\Eloquent;

use App\Criteria\ClassroomFilterCriteria;
use App\Presenters\ClassroomPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\ClassroomRepository;
use App\Entities\Classroom;
use App\Validators\ClassroomValidator;

/**
 * Class ClassroomRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class ClassroomRepositoryEloquent extends BaseRepository implements ClassroomRepository
{
    protected $fieldSearchable = [
        'number',
        'name',
        'location',
        'square',
        'floor',
        'is_free',
        'building_name' => 'like',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Classroom::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ClassroomValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
        $this->pushCriteria(ClassroomFilterCriteria::class);

        $this->setPresenter(ClassroomPresenter::class);
    }
}
