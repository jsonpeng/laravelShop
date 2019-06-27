<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAttachEvalsRequest;
use App\Http\Requests\UpdateAttachEvalsRequest;
use App\Repositories\AttachEvalsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AttachEvalsController extends AppBaseController
{
    /** @var  AttachEvalsRepository */
    private $attachEvalsRepository;

    public function __construct(AttachEvalsRepository $attachEvalsRepo)
    {
        $this->attachEvalsRepository = $attachEvalsRepo;
    }

    /**
     * Display a listing of the AttachEvals.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->attachEvalsRepository->pushCriteria(new RequestCriteria($request));
        $attachEvals = $this->attachEvalsRepository->all();

        return view('attach_evals.index')
            ->with('attachEvals', $attachEvals);
    }

    /**
     * Show the form for creating a new AttachEvals.
     *
     * @return Response
     */
    public function create()
    {
        return view('attach_evals.create');
    }

    /**
     * Store a newly created AttachEvals in storage.
     *
     * @param CreateAttachEvalsRequest $request
     *
     * @return Response
     */
    public function store(CreateAttachEvalsRequest $request)
    {
        $input = $request->all();

        $attachEvals = $this->attachEvalsRepository->create($input);

        Flash::success('Attach Evals saved successfully.');

        return redirect(route('attachEvals.index'));
    }

    /**
     * Display the specified AttachEvals.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $attachEvals = $this->attachEvalsRepository->findWithoutFail($id);

        if (empty($attachEvals)) {
            Flash::error('Attach Evals not found');

            return redirect(route('attachEvals.index'));
        }

        return view('attach_evals.show')->with('attachEvals', $attachEvals);
    }

    /**
     * Show the form for editing the specified AttachEvals.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $attachEvals = $this->attachEvalsRepository->findWithoutFail($id);

        if (empty($attachEvals)) {
            Flash::error('Attach Evals not found');

            return redirect(route('attachEvals.index'));
        }

        return view('attach_evals.edit')->with('attachEvals', $attachEvals);
    }

    /**
     * Update the specified AttachEvals in storage.
     *
     * @param  int              $id
     * @param UpdateAttachEvalsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAttachEvalsRequest $request)
    {
        $attachEvals = $this->attachEvalsRepository->findWithoutFail($id);

        if (empty($attachEvals)) {
            Flash::error('Attach Evals not found');

            return redirect(route('attachEvals.index'));
        }

        $attachEvals = $this->attachEvalsRepository->update($request->all(), $id);

        Flash::success('Attach Evals updated successfully.');

        return redirect(route('attachEvals.index'));
    }

    /**
     * Remove the specified AttachEvals from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $attachEvals = $this->attachEvalsRepository->findWithoutFail($id);

        if (empty($attachEvals)) {
            Flash::error('Attach Evals not found');

            return redirect(route('attachEvals.index'));
        }

        $this->attachEvalsRepository->delete($id);

        Flash::success('Attach Evals deleted successfully.');

        return redirect(route('attachEvals.index'));
    }
}
