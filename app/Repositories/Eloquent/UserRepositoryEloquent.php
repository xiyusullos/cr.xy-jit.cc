<?php

namespace App\Repositories\Eloquent;

use App\Presenters\UserPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\UserRepository;
use App\Entities\User;
use App\Validators\UserValidator;

/**
 * Class UserRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return UserValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));

        $this->setPresenter(UserPresenter::class);
    }


    public function postLogin()
    {
        return $this->loginByEmail(request()->input('email'), request()->input('password'));
    }

    protected function loginByEmail($email, $password)
    {
        $token = \JWTAuth::attempt([
            'email' => $email,
            'password' => $password,
        ]);
        $user = \JWTAuth::toUser($token);
        $result = $this->parserResult($user);

        return $result;
    }
    public function putResetPassword()
    {
        return $this->resetPasswordByEmail(
            request()->input('email'),
            request()->input('password', null),
            0
        );
    }

    protected function resetPasswordByEmail($email, $password, $code)
    {
        $user = $this->model->where('email', $email)->first();
        if (!empty($user->password)) {
            $user->password = bcrypt($password);
        }
        $user->save();

        return $this->parserResult($user);
    }
}
