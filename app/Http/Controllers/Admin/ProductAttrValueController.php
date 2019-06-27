<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateProductAttrValueRequest;
use App\Http\Requests\UpdateProductAttrValueRequest;
use App\Repositories\ProductAttrValueRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProductAttrValueController extends AppBaseController
{
    /** @var  ProductAttrValueRepository */
    private $productAttrValueRepository;

    public function __construct(ProductAttrValueRepository $productAttrValueRepo)
    {
        $this->productAttrValueRepository = $productAttrValueRepo;
    }

    /**
     * Display a listing of the ProductAttrValue.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->productAttrValueRepository->pushCriteria(new RequestCriteria($request));
        $productAttrValues = $this->productAttrValueRepository->all();

        return view('product_attr_values.index')
            ->with('productAttrValues', $productAttrValues);
    }

    /**
     * Show the form for creating a new ProductAttrValue.
     *
     * @return Response
     */
    public function create()
    {
        return view('product_attr_values.create');
    }

    /**
     * Store a newly created ProductAttrValue in storage.
     *
     * @param CreateProductAttrValueRequest $request
     *
     * @return Response
     */
    public function store(CreateProductAttrValueRequest $request)
    {
        $input = $request->all();

        $productAttrValue = $this->productAttrValueRepository->create($input);

        Flash::success('Product Attr Value saved successfully.');

        return redirect(route('productAttrValues.index'));
    }

    /**
     * Display the specified ProductAttrValue.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productAttrValue = $this->productAttrValueRepository->findWithoutFail($id);

        if (empty($productAttrValue)) {
            Flash::error('Product Attr Value not found');

            return redirect(route('productAttrValues.index'));
        }

        return view('product_attr_values.show')->with('productAttrValue', $productAttrValue);
    }

    /**
     * Show the form for editing the specified ProductAttrValue.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productAttrValue = $this->productAttrValueRepository->findWithoutFail($id);

        if (empty($productAttrValue)) {
            Flash::error('Product Attr Value not found');

            return redirect(route('productAttrValues.index'));
        }

        return view('product_attr_values.edit')->with('productAttrValue', $productAttrValue);
    }

    /**
     * Update the specified ProductAttrValue in storage.
     *
     * @param  int              $id
     * @param UpdateProductAttrValueRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductAttrValueRequest $request)
    {
        $productAttrValue = $this->productAttrValueRepository->findWithoutFail($id);

        if (empty($productAttrValue)) {
            Flash::error('Product Attr Value not found');

            return redirect(route('productAttrValues.index'));
        }

        $productAttrValue = $this->productAttrValueRepository->update($request->all(), $id);

        Flash::success('Product Attr Value updated successfully.');

        return redirect(route('productAttrValues.index'));
    }

    /**
     * Remove the specified ProductAttrValue from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $productAttrValue = $this->productAttrValueRepository->findWithoutFail($id);

        if (empty($productAttrValue)) {
            Flash::error('Product Attr Value not found');

            return redirect(route('productAttrValues.index'));
        }

        $this->productAttrValueRepository->delete($id);

        Flash::success('Product Attr Value deleted successfully.');

        return redirect(route('productAttrValues.index'));
    }
}
