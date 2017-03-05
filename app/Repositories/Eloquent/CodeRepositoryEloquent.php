<?php

namespace App\Repositories\Eloquent;

use App\Entities\Code;
use App\Mail\RegistrationEmail;
use App\Repositories\Contracts\CodeRepository;
use App\Validators\CodeValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class CodeRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class CodeRepositoryEloquent extends BaseRepository implements CodeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Code::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return CodeValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function create(array $attributes)
    {
        $attributes['code'] = sprintf('%06d', mt_rand(0, 999999));
        $attributes['expiration'] = 120;

        // send email
        if (app()->environment() != 'local') {
            \Mail::to($attributes['email'])->send(new RegistrationEmail($attributes['email'], $attributes['code']));
        }

        return parent::create($attributes);
    }
}
