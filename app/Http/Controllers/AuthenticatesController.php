<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\AuthenticateUpdateRequest;
use App\Repositories\Contracts\AuthenticateRepository;
use App\Validators\AuthenticateValidator;

use JWTAuth;

class AuthenticatesController extends Controller
{

    /**
     * @var AuthenticateRepository
     */
    protected $repository;

    /**
     * @var AuthenticateValidator
     */
    protected $validator;

    public function __construct(AuthenticateRepository $repository, AuthenticateValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $authenticates = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $authenticates,
            ]);
        }

        return view('authenticates.index', compact('authenticates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LoginRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $user = $this->repository->postLogin();

            $response = [
                'message' => 'Authenticate created.',
                'data'    => $user,
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function resetPassword(Request $request)
    {
        $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

        $user = $this->repository->putResetPassword();

        $response = [
            'message' => 'Password reseted',
            'data' => $user,
        ];

        if ($request->wantsJson()) {

            return response()->json($response);
        }

        return redirect()->back()->withErrors('message', $response['message']);

    }

    public function sendCode(Request $request)
    {

    }
}
