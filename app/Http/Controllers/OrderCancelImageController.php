<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderCancelImageRequest;
use App\Http\Requests\UpdateOrderCancelImageRequest;
use App\Repositories\OrderCancelImageRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class OrderCancelImageController extends AppBaseController
{
    /** @var  OrderCancelImageRepository */
    private $orderCancelImageRepository;

    public function __construct(OrderCancelImageRepository $orderCancelImageRepo)
    {
        $this->orderCancelImageRepository = $orderCancelImageRepo;
    }

    /**
     * Display a listing of the OrderCancelImage.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->orderCancelImageRepository->pushCriteria(new RequestCriteria($request));
        $orderCancelImages = $this->orderCancelImageRepository->all();

        return view('order_cancel_images.index')
            ->with('orderCancelImages', $orderCancelImages);
    }

    /**
     * Show the form for creating a new OrderCancelImage.
     *
     * @return Response
     */
    public function create()
    {
        return view('order_cancel_images.create');
    }

    /**
     * Store a newly created OrderCancelImage in storage.
     *
     * @param CreateOrderCancelImageRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderCancelImageRequest $request)
    {
        $input = $request->all();

        $orderCancelImage = $this->orderCancelImageRepository->create($input);

        Flash::success('Order Cancel Image saved successfully.');

        return redirect(route('orderCancelImages.index'));
    }

    /**
     * Display the specified OrderCancelImage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $orderCancelImage = $this->orderCancelImageRepository->findWithoutFail($id);

        if (empty($orderCancelImage)) {
            Flash::error('Order Cancel Image not found');

            return redirect(route('orderCancelImages.index'));
        }

        return view('order_cancel_images.show')->with('orderCancelImage', $orderCancelImage);
    }

    /**
     * Show the form for editing the specified OrderCancelImage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $orderCancelImage = $this->orderCancelImageRepository->findWithoutFail($id);

        if (empty($orderCancelImage)) {
            Flash::error('Order Cancel Image not found');

            return redirect(route('orderCancelImages.index'));
        }

        return view('order_cancel_images.edit')->with('orderCancelImage', $orderCancelImage);
    }

    /**
     * Update the specified OrderCancelImage in storage.
     *
     * @param  int              $id
     * @param UpdateOrderCancelImageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderCancelImageRequest $request)
    {
        $orderCancelImage = $this->orderCancelImageRepository->findWithoutFail($id);

        if (empty($orderCancelImage)) {
            Flash::error('Order Cancel Image not found');

            return redirect(route('orderCancelImages.index'));
        }

        $orderCancelImage = $this->orderCancelImageRepository->update($request->all(), $id);

        Flash::success('Order Cancel Image updated successfully.');

        return redirect(route('orderCancelImages.index'));
    }

    /**
     * Remove the specified OrderCancelImage from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $orderCancelImage = $this->orderCancelImageRepository->findWithoutFail($id);

        if (empty($orderCancelImage)) {
            Flash::error('Order Cancel Image not found');

            return redirect(route('orderCancelImages.index'));
        }

        $this->orderCancelImageRepository->delete($id);

        Flash::success('Order Cancel Image deleted successfully.');

        return redirect(route('orderCancelImages.index'));
    }
}
