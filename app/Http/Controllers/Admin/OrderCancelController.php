<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateOrderCancelRequest;
use App\Http\Requests\UpdateOrderCancelRequest;
use App\Repositories\OrderCancelRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

use App\Models\Order;

class OrderCancelController extends AppBaseController
{
    /** @var  OrderCancelRepository */
    private $orderCancelRepository;

    public function __construct(OrderCancelRepository $orderCancelRepo)
    {
        $this->orderCancelRepository = $orderCancelRepo;
    }

    /**
     * Display a listing of the OrderCancel.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        //$this->orderCancelRepository->pushCriteria(new RequestCriteria($request));
        $orderCancels = $this->orderCancelRepository->all();

        return view('admin.order_cancels.index')
            ->with('orderCancels', $orderCancels);
    }

    /**
     * Show the form for creating a new OrderCancel.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.order_cancels.create');
    }

    /**
     * Store a newly created OrderCancel in storage.
     *
     * @param CreateOrderCancelRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderCancelRequest $request)
    {
        $input = $request->all();

        $orderCancel = $this->orderCancelRepository->create($input);

        Flash::success('Order Cancel saved successfully.');

        return redirect(route('orderCancels.index'));
    }

    /**
     * Display the specified OrderCancel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $orderCancel = $this->orderCancelRepository->findWithoutFail($id);

        if (empty($orderCancel)) {
            Flash::error('Order Cancel not found');

            return redirect(route('orderCancels.index'));
        }

        return view('admin.order_cancels.show')->with('orderCancel', $orderCancel);
    }

    /**
     * Show the form for editing the specified OrderCancel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $orderCancel = $this->orderCancelRepository->findWithoutFail($id);

        if (empty($orderCancel)) {
            Flash::error('Order Cancel not found');

            return redirect(route('orderCancels.index'));
        }

        return view('admin.order_cancels.edit')->with('orderCancel', $orderCancel);
    }

    /**
     * Update the specified OrderCancel in storage.
     *
     * @param  int              $id
     * @param UpdateOrderCancelRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $orderCancel = $this->orderCancelRepository->findWithoutFail($id);

        if (empty($orderCancel)) {
            Flash::error('Order Cancel not found');

            return redirect(route('orderCancels.index'));
        }

        $inputs = $request->all();
        $orderCancel = $this->orderCancelRepository->update($inputs, $id);

        //修改订单状态
        if (array_key_exists('auth', $inputs)) {
            $result = '确认退款';
            if ($inputs['auth'] == 2) {
                # 通过审核， 退款
                $result = '审核拒绝';
            }
            $order = Order::where('id', $orderCancel->order_id)->first();
            if (empty($order)) {
                Flash::error('订单'.$orderCancel->id.'不存在');
                return redirect(route('orderCancels.index'));
            }
            $admin = auth('admin')->user();
            $remark = $inputs['remark'];
            if (empty($remark)) {
                $remark = '无';
            }
            app('commonRepo')->addOrderLog($order->order_status, $order->order_delivery, $order->order_pay, $result, $remark, $admin->showName, $order->id);

            //退款操作
            if ($inputs['auth'] == 1) {
                # 通过审核， 退款
                $this->orderCancelRepository->returnMoeny($orderCancel->id);
            }
        }

        
        Flash::success('Order Cancel updated successfully.');

        return redirect(route('orderCancels.index'));
    }

    /**
     * Remove the specified OrderCancel from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $orderCancel = $this->orderCancelRepository->findWithoutFail($id);

        if (empty($orderCancel)) {
            Flash::error('Order Cancel not found');

            return redirect(route('orderCancels.index'));
        }

        $this->orderCancelRepository->delete($id);

        Flash::success('Order Cancel deleted successfully.');

        return redirect(route('orderCancels.index'));
    }
}
