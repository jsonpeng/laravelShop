<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateSpecProductPriceRequest;
use App\Http\Requests\UpdateSpecProductPriceRequest;
use App\Repositories\SpecProductPriceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SpecProductPriceController extends AppBaseController
{
    /** @var  SpecProductPriceRepository */
    private $specProductPriceRepository;

    public function __construct(SpecProductPriceRepository $specProductPriceRepo)
    {
        $this->specProductPriceRepository = $specProductPriceRepo;
    }

    /**
     * Display a listing of the SpecProductPrice.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->specProductPriceRepository->pushCriteria(new RequestCriteria($request));
        $specProductPrices = $this->specProductPriceRepository->all();

        return view('spec_product_prices.index')
            ->with('specProductPrices', $specProductPrices);
    }

    /**
     * Show the form for creating a new SpecProductPrice.
     *
     * @return Response
     */
    public function create()
    {
        return view('spec_product_prices.create');
    }

    /**
     * Store a newly created SpecProductPrice in storage.
     *
     * @param CreateSpecProductPriceRequest $request
     *
     * @return Response
     */
    public function store(CreateSpecProductPriceRequest $request)
    {
        $input = $request->all();

        $specProductPrice = $this->specProductPriceRepository->create($input);

        Flash::success('Spec Product Price saved successfully.');

        return redirect(route('specProductPrices.index'));
    }

    /**
     * Display the specified SpecProductPrice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $specProductPrice = $this->specProductPriceRepository->findWithoutFail($id);

        if (empty($specProductPrice)) {
            Flash::error('Spec Product Price not found');

            return redirect(route('specProductPrices.index'));
        }

        return view('spec_product_prices.show')->with('specProductPrice', $specProductPrice);
    }

    /**
     * Show the form for editing the specified SpecProductPrice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $specProductPrice = $this->specProductPriceRepository->findWithoutFail($id);

        if (empty($specProductPrice)) {
            Flash::error('Spec Product Price not found');

            return redirect(route('specProductPrices.index'));
        }

        return view('spec_product_prices.edit')->with('specProductPrice', $specProductPrice);
    }

    /**
     * Update the specified SpecProductPrice in storage.
     *
     * @param  int              $id
     * @param UpdateSpecProductPriceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSpecProductPriceRequest $request)
    {
        $specProductPrice = $this->specProductPriceRepository->findWithoutFail($id);

        if (empty($specProductPrice)) {
            Flash::error('Spec Product Price not found');

            return redirect(route('specProductPrices.index'));
        }

        $specProductPrice = $this->specProductPriceRepository->update($request->all(), $id);

        Flash::success('Spec Product Price updated successfully.');

        return redirect(route('specProductPrices.index'));
    }

    /**
     * Remove the specified SpecProductPrice from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $specProductPrice = $this->specProductPriceRepository->findWithoutFail($id);

        if (empty($specProductPrice)) {
            Flash::error('Spec Product Price not found');

            return redirect(route('specProductPrices.index'));
        }

        $this->specProductPriceRepository->delete($id);

        Flash::success('Spec Product Price deleted successfully.');

        return redirect(route('specProductPrices.index'));
    }
}
