<?php

namespace App\Repositories\Eloquent;

use App\Presenters\AuthenticatePresenter;
use Illuminate\Container\Container as Application;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\AuthenticateRepository;
use App\Entities\Authenticate;
use App\Validators\AuthenticateValidator;
use JWTAuth;

/**
 * Class AuthenticateRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class AuthenticateRepositoryEloquent extends BaseRepository implements AuthenticateRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Authenticate::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AuthenticateValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));

        $this->setPresenter(AuthenticatePresenter::class);
    }

    public function postLogin()
    {
        return $this->loginByEmail(request()->input('email'), request()->input('password'));
    }

    protected function loginByEmail($email, $password)
    {
        $token = JWTAuth::attempt([
            'email' => $email,
            'password' => $password,
        ]);
        $user = JWTAuth::toUser($token);
        $result = $this->parserResult($user);

        return $result;
    }
}
