<?php

namespace App\Http\Controllers;

use App\Criteria\ClassroomFilterCriteria;
use App\Entities\Classroom;
use App\Presenters\ClassroomPresenter;
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

// use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\MessageBag;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ClassroomCreateRequest;
use App\Http\Requests\ClassroomUpdateRequest;
use App\Repositories\Contracts\ClassroomRepository;
use App\Validators\ClassroomValidator;


/**
 * Class ClassroomsController
 *
 * @package App\Http\Controllers
 *
 * @resource 02-classrooms
 */
class ClassroomsController extends Controller
{
    use ModelForm;

    /**
     * @var ClassroomRepository
     */
    protected $repository;

    /**
     * @var ClassroomValidator
     */
    protected $validator;

    public function __construct(ClassroomRepository $repository, ClassroomValidator $validator)
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
        return Admin::grid(Classroom::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            // $grid->column();

            $grid->column('number', '编号');
            $grid->column('name', '名称');
            $grid->column('location', '地点');
            $grid->column('square', '面积');
            $grid->column('floor', '楼层');
            $grid->column('is_free', '是否空闲');
            $grid->column('building_name', '建筑物名称');

            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Classroom::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('number', '编号')->placeholder('教室编号');
            $form->text('name', '名称')->placeholder('教室名称');
            $form->text('location', '地点')->placeholder('教室地点');
            $form->text('square', '面积')->placeholder('教室面积');
            $form->number('floor', '楼层')->placeholder('教室楼层');
            $form->radio('is_free', '是否空闲')->options([0 => '占用', 1 => '空闲',])->default(1);
            $form->text('building_name', '建筑物名称')->placeholder('教室所处建筑物名称');

            $form->display('created_at', '创建于');
            $form->display('updated_at', '更新于');
        });
    }


    /**
     * 教室列表
     *      当前可用教室查看 /api/classrooms?search=is_free:1
     *      筛选可用教室（面积大小、教学楼、时间段）
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $this->repository->pushCriteria(ClassroomFilterCriteria::class);
        $classrooms = $this->repository->paginate();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $classrooms,
            ]);
        }

        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });

        return view('classrooms.index', compact('classrooms'));
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
     * @param  ClassroomCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ClassroomCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $classroom = $this->repository->create($request->all());

            $response = [
                'message' => 'Classroom created.',
                'data'    => $classroom,
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

            return redirect()->back()
                ->withErrors($e->getMessageBag())
                // ->withErrors([
                //     'title' => trans('admin::lang.failed'),
                //     'message' => $e->getMessageBag(),
                // ])
                ->withInput();
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
        $classroom = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $classroom,
            ]);
        }

        return view('classrooms.show', compact('classroom'));
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

        $classroom = $this->repository->find($id);

        return view('classrooms.edit', compact('classroom'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ClassroomUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(ClassroomUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $classroom = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Classroom updated.',
                'data'    => $classroom,
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            $success = new MessageBag([
                'title'   => trans('admin::lang.succeeded'),
                'message' => trans('admin::lang.update_succeeded'),
            ]);

            return redirect()->back()->with('message', $response['message'])->with(compact('success'));
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            dd(__FILE__);
            return redirect()->back()->withErrors($e->getMessageBag())
                ->withErrors([
                    'title' => trans('admin::lang.failed'),
                    'message' => $e->getMessageBag(),
                ])
                ->withInput();
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
                'message' => 'Classroom deleted.',
                'deleted' => $deleted,
            ]);
        }

        $success = new MessageBag([
            'title'   => trans('admin::lang.succeeded'),
            'message' => trans('admin::lang.delete_succeeded'),
        ]);

        return redirect()->back()->with('message', 'Classroom deleted.')->with(compact('success'));
    }
}
