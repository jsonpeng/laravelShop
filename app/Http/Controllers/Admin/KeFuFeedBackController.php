<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateKeFuFeedBackRequest;
use App\Http\Requests\UpdateKeFuFeedBackRequest;
use App\Repositories\KeFuFeedBackRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class KeFuFeedBackController extends AppBaseController
{
    /** @var  KeFuFeedBackRepository */
    private $keFuFeedBackRepository;

    public function __construct(KeFuFeedBackRepository $keFuFeedBackRepo)
    {
        $this->keFuFeedBackRepository = $keFuFeedBackRepo;
    }

    /**
     * Display a listing of the KeFuFeedBack.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->keFuFeedBackRepository->pushCriteria(new RequestCriteria($request));
        $keFuFeedBacks = $this->keFuFeedBackRepository->all();

        return view('admin.ke_fu_feed_backs.index')
            ->with('keFuFeedBacks', $keFuFeedBacks);
    }

    /**
     * Show the form for creating a new KeFuFeedBack.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.ke_fu_feed_backs.create');
    }

    /**
     * Store a newly created KeFuFeedBack in storage.
     *
     * @param CreateKeFuFeedBackRequest $request
     *
     * @return Response
     */
    public function store(CreateKeFuFeedBackRequest $request)
    {
        $input = $request->all();

        $keFuFeedBack = $this->keFuFeedBackRepository->create($input);

        Flash::success('Ke Fu Feed Back saved successfully.');

        return redirect(route('keFuFeedBacks.index'));
    }

    /**
     * Display the specified KeFuFeedBack.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $keFuFeedBack = $this->keFuFeedBackRepository->findWithoutFail($id);

        if (empty($keFuFeedBack)) {
            Flash::error('没有找到该条记录');

            return redirect(route('keFuFeedBacks.index'));
        }

        return view('ke_fu_feed_backs.show')->with('keFuFeedBack', $keFuFeedBack);
    }

    /**
     * Show the form for editing the specified KeFuFeedBack.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $keFuFeedBack = $this->keFuFeedBackRepository->findWithoutFail($id);

        if (empty($keFuFeedBack)) {
            Flash::error('没有找到该条记录');

            return redirect(route('keFuFeedBacks.index'));
        }

        return view('admin.ke_fu_feed_backs.edit')->with('keFuFeedBack', $keFuFeedBack);
    }

    /**
     * Update the specified KeFuFeedBack in storage.
     *
     * @param  int              $id
     * @param UpdateKeFuFeedBackRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKeFuFeedBackRequest $request)
    {
        $keFuFeedBack = $this->keFuFeedBackRepository->findWithoutFail($id);

        if (empty($keFuFeedBack)) {
            Flash::error('没有找到该条记录');

            return redirect(route('keFuFeedBacks.index'));
        }

        $keFuFeedBack = $this->keFuFeedBackRepository->update($request->all(), $id);

        Flash::success('更新成功');

        return redirect(route('keFuFeedBacks.index'));
    }

    /**
     * Remove the specified KeFuFeedBack from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $keFuFeedBack = $this->keFuFeedBackRepository->findWithoutFail($id);

        if (empty($keFuFeedBack)) {
            Flash::error('没有找到该条记录');

            return redirect(route('keFuFeedBacks.index'));
        }

        $this->keFuFeedBackRepository->delete($id);

        Flash::success('删除成功.');

        return redirect(route('keFuFeedBacks.index'));
    }
}
