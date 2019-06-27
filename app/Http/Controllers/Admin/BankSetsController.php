<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateBankSetsRequest;
use App\Http\Requests\UpdateBankSetsRequest;
use App\Repositories\BankSetsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class BankSetsController extends AppBaseController
{
    /** @var  BankSetsRepository */
    private $bankSetsRepository;

    public function __construct(BankSetsRepository $bankSetsRepo)
    {
        $this->bankSetsRepository = $bankSetsRepo;
    }

    /**
     * Display a listing of the BankSets.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->bankSetsRepository->pushCriteria(new RequestCriteria($request));
        $bankSets = descAndPaginateToShow($this->bankSetsRepository);
        //return $bankSets;
        return view('admin.bank_sets.index')
            ->with('bankSets', $bankSets);
    }

    /**
     * Show the form for creating a new BankSets.
     *
     * @return Response
     */
    public function create()
    {
        $bankSets=null;
        return view('admin.bank_sets.create')->with('bankSets',$bankSets);
    }

    /**
     * Store a newly created BankSets in storage.
     *
     * @param CreateBankSetsRequest $request
     *
     * @return Response
     */
    public function store(CreateBankSetsRequest $request)
    {
        $input = $request->all();

        $bankSets = $this->bankSetsRepository->create($input);

        Flash::success('保存成功.');

        return redirect(route('bankSets.index'));
    }

    /**
     * Display the specified BankSets.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bankSets = $this->bankSetsRepository->findWithoutFail($id);

        if (empty($bankSets)) {
            Flash::error('银行信息不存在');

            return redirect(route('bankSets.index'));
        }

        return view('admin.bank_sets.show')->with('bankSets', $bankSets);
    }

    /**
     * Show the form for editing the specified BankSets.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bankSets = $this->bankSetsRepository->findWithoutFail($id);

        if (empty($bankSets)) {
            Flash::error('银行信息不存在');

            return redirect(route('bankSets.index'));
        }

        return view('admin.bank_sets.edit')->with('bankSets', $bankSets);
    }

    /**
     * Update the specified BankSets in storage.
     *
     * @param  int              $id
     * @param UpdateBankSetsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBankSetsRequest $request)
    {
        $bankSets = $this->bankSetsRepository->findWithoutFail($id);

        if (empty($bankSets)) {
            Flash::error('银行信息不存在');

            return redirect(route('bankSets.index'));
        }

        $bankSets = $this->bankSetsRepository->update($request->all(), $id);

        Flash::success('保存成功.');

        return redirect(route('bankSets.index'));
    }

    /**
     * Remove the specified BankSets from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bankSets = $this->bankSetsRepository->findWithoutFail($id);

        if (empty($bankSets)) {
            Flash::error('银行信息不存在');

            return redirect(route('bankSets.index'));
        }

        $this->bankSetsRepository->delete($id);

        Flash::success('删除成功.');

        return redirect(route('bankSets.index'));
    }
}
