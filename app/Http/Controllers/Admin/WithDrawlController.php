<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateWithDrawlRequest;
use App\Http\Requests\UpdateWithDrawlRequest;
use App\Repositories\WithDrawlRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\User;

class WithDrawlController extends AppBaseController
{
    /** @var  WithDrawlRepository */
    private $withDrawlRepository;

    public function __construct(WithDrawlRepository $withDrawlRepo)
    {
        $this->withDrawlRepository = $withDrawlRepo;
    }

    /**
     * Display a listing of the WithDrawl.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->withDrawlRepository->pushCriteria(new RequestCriteria($request));
        $withDrawls = $this->withDrawlRepository->descToShow();

        return view('admin.with_drawls.index')
            ->with('withDrawls', $withDrawls);
    }

    /**
     * Show the form for creating a new WithDrawl.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.with_drawls.create');
    }

    /**
     * Store a newly created WithDrawl in storage.
     *
     * @param CreateWithDrawlRequest $request
     *
     * @return Response
     */
    public function store(CreateWithDrawlRequest $request)
    {
        $input = $request->all();

        $withDrawl = $this->withDrawlRepository->create($input);

        Flash::success('With Drawl saved successfully.');

        return redirect(route('withDrawls.index'));
    }

    /**
     * Display the specified WithDrawl.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $withDrawl = $this->withDrawlRepository->findWithoutFail($id);

        if (empty($withDrawl)) {
            Flash::error('With Drawl not found');

            return redirect(route('withDrawls.index'));
        }

        return view('admin.with_drawls.show')->with('withDrawl', $withDrawl);
    }

    /**
     * Show the form for editing the specified WithDrawl.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $withDrawl = $this->withDrawlRepository->findWithoutFail($id);

        if (empty($withDrawl)) {
            Flash::error('With Drawl not found');

            return redirect(route('withDrawls.index'));
        }

        return view('admin.with_drawls.edit')->with('withDrawl', $withDrawl);
    }

    /**
     * Update the specified WithDrawl in storage.
     *
     * @param  int              $id
     * @param UpdateWithDrawlRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWithDrawlRequest $request)
    {
        $withDrawl = $this->withDrawlRepository->findWithoutFail($id);
        $input=$request->all();
        if (empty($withDrawl)) {
            Flash::error('With Drawl not found');

            return redirect(route('withDrawls.index'));
        }
        if($input['status']=='撤回'){
            $account_tem=$input['account_tem']+$input['price'];
            $input['account_tem']=$account_tem;
            $user=User::find($input['user_id']);
            if(!empty($user)){
                $user->update(['user_money'=>$account_tem]);
            }
        }

        $withDrawl = $this->withDrawlRepository->update($input, $id);

        Flash::success('更新成功.');

        return redirect(route('withDrawls.index'));
    }

    /**
     * Remove the specified WithDrawl from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $withDrawl = $this->withDrawlRepository->findWithoutFail($id);

        if (empty($withDrawl)) {
            Flash::error('With Drawl not found');

            return redirect(route('withDrawls.index'));
        }

        $this->withDrawlRepository->delete($id);

        Flash::success('删除成功.');

        return redirect(route('withDrawls.index'));
    }
}
