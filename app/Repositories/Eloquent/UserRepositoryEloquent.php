<?php

namespace App\Repositories\Eloquent;

use App\Entities\User;
use App\Presenters\UserPresenter;
use App\Repositories\Contracts\UserRepository;
use App\Validators\UserValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

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
        $token = \JWTAuth::attempt(['email' => $email, 'password' => $password,]);
        $user = \JWTAuth::toUser($token);
        $result = $this->parserResult($user);

        return $result;
    }

    public function putResetPassword()
    {
        return $this->resetPasswordByEmail(request()->input('email'), request()->input('password', null));
    }

    protected function resetPasswordByEmail($email, $password)
    {
        $user = $this->model->where('email', $email)->first();
        if (!empty($user->password)) {
            $user->password = bcrypt($password);
        }
        $user->save();

        return $this->parserResult($user);
    }

    public function create(array $attributes)
    {
        $attributes['password'] = bcrypt($attributes['password']);

        return parent::create($attributes);
    }

    public function update(array $attributes, $id)
    {
        if (isset($attributes['password'])) {
            $attributes['password'] = bcrypt($attributes['password']);
        }
        return parent::update($attributes, $id);
    }
}
