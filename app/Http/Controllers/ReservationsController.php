<?php

namespace App\Http\Controllers;

use App\Criteria\ReservationsWithClassroomCriteria;
use App\Entities\Classroom;
use App\Entities\Reservation;
use App\Models\AdminUser;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Chart\Bar;
use Encore\Admin\Widgets\Chart\Doughnut;
use Encore\Admin\Widgets\Chart\Line;
use Encore\Admin\Widgets\Chart\Pie;
use Encore\Admin\Widgets\Chart\PolarArea;
use Encore\Admin\Widgets\Chart\Radar;
use Encore\Admin\Widgets\Collapse;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Tab;
use Encore\Admin\Widgets\Table;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Controllers\ModelForm;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\MessageBag;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ReservationCreateRequest;
use App\Http\Requests\ReservationUpdateRequest;
use App\Repositories\Contracts\ReservationRepository;
use App\Validators\ReservationValidator;


/**
 * Class ReservationsController
 * @package App\Http\Controllers
 * @resource 03-reservations
 * 教室租赁
 */
class ReservationsController extends Controller
{

    /**
     * @var ReservationRepository
     */
    protected $repository;

    /**
     * @var ReservationValidator
     */
    protected $validator;

    public function __construct(ReservationRepository $repository, ReservationValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Reservation::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            // The type of relation like adminUser has a bug!
            $grid->column('admin_user.name', '用户姓名');
            $grid->column('classroom.number', '教室编号');
            $grid->column('租赁时间段')->display(function () {
                return '从'. $this->begin_time .'到'. $this->end_time;
            });

            $grid->created_at('创建于');
            $grid->updated_at('更新于');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Reservation::class, function (Form $form) {

            $form->display('id', 'ID');

            // $form->text('number', '编号')->placeholder('教室编号');
            $form->select('user_id', '用户')->options(function ($id) {
                // $adminUser = AdminUser::find($id);
                // if ($adminUser) {
                //     return [$adminUser->id => $adminUser->name];
                // }
                $adminUsers = AdminUser::all();
                $value = [];
                foreach ($adminUsers as $adminUser) {
                    $value[$adminUser->id] = $adminUser->name;
                }

                return $value;
            });
            $form->select('classroom_id', '教室')->options(function ($id) {
                // $adminUser = AdminUser::find($id);
                // if ($adminUser) {
                //     return [$adminUser->id => $adminUser->name];
                // }
                $classrooms = Classroom::all();
                $value = [];
                foreach ($classrooms as $classroom) {
                    $value[$classroom->id] = $classroom->number;
                }

                return $value;
            });
            $form->datetime('begin_time', '开始租赁时间');
            $form->datetime('end_time', '结束租赁时间');

            $form->display('created_at', '创建于');
            $form->display('updated_at', '更新于');
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        // pick out where the classroom is deleted
        $this->repository->pushCriteria(new ReservationsWithClassroomCriteria());
        $reservations = $this->repository->paginate();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $reservations,
            ]);
        }

        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });

        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ReservationCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $reservation = $this->repository->create($request->all());

            $response = [
                'message' => 'Reservations created.',
                'data'    => $reservation,
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            $success = new MessageBag([
                'title'   => trans('admin::lang.succeeded'),
                'message' => trans('admin::lang.save_succeeded'),
            ]);

            return redirect()->back()->with('message', $response['message'])->with(compact('success'));
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


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservation = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $reservation,
            ]);
        }

        return view('reservations.show', compact('reservation'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });

        $reservation = $this->repository->find($id);

        return view('reservations.edit', compact('reservation'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ReservationUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(ReservationUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $reservation = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'Reservations updated.',
                'data'    => $reservation,
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


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Reservations deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Reservations deleted.');
    }
}
