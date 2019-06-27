<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateCertsRequest;
use App\Http\Requests\UpdateCertsRequest;
use App\Repositories\CertsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class CertsController extends AppBaseController
{
    /** @var  CertsRepository */
    private $certsRepository;

    public function __construct(CertsRepository $certsRepo)
    {
        $this->certsRepository = $certsRepo;
    }

    /**
     * Display a listing of the Certs.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->certsRepository->pushCriteria(new RequestCriteria($request));
        $certs = descAndPaginateToShow($this->certsRepository);

        return view('admin.certs.index')
            ->with('certs', $certs);
    }

    /**
     * Show the form for creating a new Certs.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.certs.create');
    }

    /**
     * Store a newly created Certs in storage.
     *
     * @param CreateCertsRequest $request
     *
     * @return Response
     */
    public function store(CreateCertsRequest $request)
    {
        $input = $request->all();

        $certs = $this->certsRepository->create($input);

        Flash::success('保存成功.');

        return redirect(route('certs.index'));
    }

    /**
     * Display the specified Certs.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $certs = $this->certsRepository->findWithoutFail($id);

        if (empty($certs)) {
            Flash::error('没有找到该记录');

            return redirect(route('certs.index'));
        }

        return view('admin.certs.show')->with('certs', $certs);
    }

    /**
     * Show the form for editing the specified Certs.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $certs = $this->certsRepository->findWithoutFail($id);

        if (empty($certs)) {
            Flash::error('没有找到该记录');

            return redirect(route('certs.index'));
        }

        return view('admin.certs.edit')->with('certs', $certs);
    }

    /**
     * Update the specified Certs in storage.
     *
     * @param  int              $id
     * @param UpdateCertsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCertsRequest $request)
    {
        $certs = $this->certsRepository->findWithoutFail($id);

        if (empty($certs)) {
            Flash::error('没有找到该记录');

            return redirect(route('certs.index'));
        }

        $certs = $this->certsRepository->update($request->all(), $id);

        Flash::success('更新成功.');

        return redirect(route('certs.index'));
    }

    /**
     * Remove the specified Certs from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $certs = $this->certsRepository->findWithoutFail($id);

        if (empty($certs)) {
            Flash::error('没有找到该记录');

            return redirect(route('certs.index'));
        }

        $this->certsRepository->delete($id);

        Flash::success('删除成功.');

        return redirect(route('certs.index'));
    }
}
