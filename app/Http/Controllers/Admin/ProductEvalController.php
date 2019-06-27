<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateProductEvalRequest;
use App\Http\Requests\UpdateProductEvalRequest;
use App\Repositories\ProductEvalRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProductEvalController extends AppBaseController
{
    /** @var  ProductEvalRepository */
    private $productEvalRepository;

    public function __construct(ProductEvalRepository $productEvalRepo)
    {
        $this->productEvalRepository = $productEvalRepo;
    }

    /**
     * Display a listing of the ProductEval.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->productEvalRepository->pushCriteria(new RequestCriteria($request));

        $productEvals = descAndPaginateToShow($this->productEvalRepository);

        return view('admin.product_evals.index')
            ->with('productEvals', $productEvals);
    }

    /**
     * Show the form for creating a new ProductEval.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.product_evals.create');
    }

    /**
     * Store a newly created ProductEval in storage.
     *
     * @param CreateProductEvalRequest $request
     *
     * @return Response
     */
    public function store(CreateProductEvalRequest $request)
    {
        $input = $request->all();

        $productEval = $this->productEvalRepository->create($input);

        Flash::success('添加评价成功.');

        return redirect(route('productEvals.index'));
    }

    /**
     * Display the specified ProductEval.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productEval = $this->productEvalRepository->findWithoutFail($id);

        if (empty($productEval)) {
            Flash::error('Product Eval not found');

            return redirect(route('productEvals.index'));
        }

        return view('admin.product_evals.show')->with('productEval', $productEval);
    }

    /**
     * Show the form for editing the specified ProductEval.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productEval = $this->productEvalRepository->findWithoutFail($id);

        if (empty($productEval)) {
            Flash::error('Product Eval not found');

            return redirect(route('productEvals.index'));
        }

        return view('admin.product_evals.edit')->with('productEval', $productEval);
    }

    /**
     * Update the specified ProductEval in storage.
     *
     * @param  int              $id
     * @param UpdateProductEvalRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductEvalRequest $request)
    {
        $productEval = $this->productEvalRepository->findWithoutFail($id);

        if (empty($productEval)) {
            Flash::error('Product Eval not found');

            return redirect(route('productEvals.index'));
        }

        $productEval = $this->productEvalRepository->update($request->all(), $id);

        Flash::success('更新评价成功.');

        return redirect(route('productEvals.index'));
    }

    /**
     * Remove the specified ProductEval from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $productEval = $this->productEvalRepository->findWithoutFail($id);

        if (empty($productEval)) {
            Flash::error('Product Eval not found');

            return redirect(route('productEvals.index'));
        }

        $this->productEvalRepository->delete($id);

        Flash::success('删除评价成功.');

        return redirect(route('productEvals.index'));
    }
}
