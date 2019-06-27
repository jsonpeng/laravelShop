<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateCatsRequest;
use App\Http\Requests\UpdateCatsRequest;
use App\Repositories\CatsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class CatsController extends AppBaseController
{
    /** @var  CatsRepository */
    private $catsRepository;

    public function __construct(CatsRepository $catsRepo)
    {
        $this->catsRepository = $catsRepo;
    }

    /**
     * Display a listing of the Cats.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->catsRepository->pushCriteria(new RequestCriteria($request));
        $cats = descAndPaginateToShow($this->catsRepository);

        return view('admin.cats.index')
            ->with('cats', $cats);
    }

    /**
     * Show the form for creating a new Cats.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.cats.create');
    }

    /**
     * Store a newly created Cats in storage.
     *
     * @param CreateCatsRequest $request
     *
     * @return Response
     */
    public function store(CreateCatsRequest $request)
    {
        $input = $request->all();

        $cats = $this->catsRepository->create($input);

        Flash::success('分类保存成功.');

        return redirect(route('cats.index'));
    }

    /**
     * Display the specified Cats.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cats = $this->catsRepository->findWithoutFail($id);

        if (empty($cats)) {
            Flash::error('没有找到该分类');

            return redirect(route('cats.index'));
        }

        return view('admin.cats.show')->with('cats', $cats);
    }

    /**
     * Show the form for editing the specified Cats.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cats = $this->catsRepository->findWithoutFail($id);

        if (empty($cats)) {
            Flash::error('没有找到该分类');

            return redirect(route('cats.index'));
        }

        return view('admin.cats.edit')->with('cats', $cats);
    }

    /**
     * Update the specified Cats in storage.
     *
     * @param  int              $id
     * @param UpdateCatsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCatsRequest $request)
    {
        $cats = $this->catsRepository->findWithoutFail($id);

        if (empty($cats)) {
            Flash::error('没有找到该分类');

            return redirect(route('cats.index'));
        }

        $cats = $this->catsRepository->update($request->all(), $id);

        Flash::success('分类更新成功');

        return redirect(route('cats.index'));
    }

    /**
     * Remove the specified Cats from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cats = $this->catsRepository->findWithoutFail($id);

        if (empty($cats)) {
            Flash::error('没有找到该分类');

            return redirect(route('cats.index'));
        }

        $this->catsRepository->delete($id);

        Flash::success('删除成功.');

        return redirect(route('cats.index'));
    }
}
