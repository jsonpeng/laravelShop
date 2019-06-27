<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateProductAttrRequest;
use App\Http\Requests\UpdateProductAttrRequest;
use App\Repositories\ProductAttrRepository;
use App\Repositories\ProductTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProductAttrController extends AppBaseController
{
    /** @var  ProductAttrRepository */
    private $productAttrRepository;
    private $productTypeRepository;

    public function __construct(ProductAttrRepository $productAttrRepo, ProductTypeRepository $productTypeRepo)
    {
        $this->productAttrRepository = $productAttrRepo;
        $this->productTypeRepository = $productTypeRepo;
    }

    /**
     * Display a listing of the ProductAttr.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->productAttrRepository->pushCriteria(new RequestCriteria($request));
        $productAttrs = $this->productAttrRepository->paginate($this->defaultPage());

        return view('admin.product_attrs.index')
            ->with('productAttrs', $productAttrs);
    }

    /**
     * Show the form for creating a new ProductAttr.
     *
     * @return Response
     */
    public function create()
    {
        $types = $this->productTypeRepository->TypeListArray();
        return view('admin.product_attrs.create', compact('types'));
    }

    /**
     * Store a newly created ProductAttr in storage.
     *
     * @param CreateProductAttrRequest $request
     *
     * @return Response
     */
    public function store(CreateProductAttrRequest $request)
    {
        $input = $request->all();

        $productAttr = $this->productAttrRepository->create($input);

        Flash::success('Product Attr saved successfully.');

        return redirect(route('productAttrs.index'));
    }

    /**
     * Display the specified ProductAttr.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productAttr = $this->productAttrRepository->findWithoutFail($id);

        if (empty($productAttr)) {
            Flash::error('Product Attr not found');

            return redirect(route('productAttrs.index'));
        }

        return view('admin.product_attrs.show')->with('productAttr', $productAttr);
    }

    /**
     * Show the form for editing the specified ProductAttr.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productAttr = $this->productAttrRepository->findWithoutFail($id);

        if (empty($productAttr)) {
            Flash::error('Product Attr not found');

            return redirect(route('productAttrs.index'));
        }

        $types = $this->productTypeRepository->TypeListArray();
        
        return view('admin.product_attrs.edit')->with('productAttr', $productAttr)->with('types', $types);
    }

    /**
     * Update the specified ProductAttr in storage.
     *
     * @param  int              $id
     * @param UpdateProductAttrRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductAttrRequest $request)
    {
        $productAttr = $this->productAttrRepository->findWithoutFail($id);

        if (empty($productAttr)) {
            Flash::error('Product Attr not found');

            return redirect(route('productAttrs.index'));
        }

        $productAttr = $this->productAttrRepository->update($request->all(), $id);

        Flash::success('Product Attr updated successfully.');

        return redirect(route('productAttrs.index'));
    }

    /**
     * Remove the specified ProductAttr from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $productAttr = $this->productAttrRepository->findWithoutFail($id);

        if (empty($productAttr)) {
            Flash::error('Product Attr not found');

            return redirect(route('productAttrs.index'));
        }

        $this->productAttrRepository->delete($id);

        Flash::success('Product Attr deleted successfully.');

        return redirect(route('productAttrs.index'));
    }
}
