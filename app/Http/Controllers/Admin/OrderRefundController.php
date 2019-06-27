<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateOrderRefundRequest;
use App\Http\Requests\UpdateOrderRefundRequest;
use App\Repositories\OrderRefundRepository;
use App\Repositories\OrderRefundImageRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Http\Requests;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\RefundLog;
use Auth;
use Illuminate\Support\Facades\Input;
use Redirect,Response;
use Illuminate\Support\Facades\Log;

class OrderRefundController extends AppBaseController
{
    /** @var  OrderRefundRepository */
    private $orderRefundRepository;
    private $orderRefundImageRepository;

    public function __construct(OrderRefundRepository $orderRefundRepo,OrderRefundImageRepository $orderRefundImageRepo)
    {
        $this->orderRefundRepository = $orderRefundRepo;
        $this->orderRefundImageRepository=$orderRefundImageRepo;
    }

    /**
     * Display a listing of the OrderRefund.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->orderRefundRepository->pushCriteria(new RequestCriteria($request));
        $orderRefunds = $this->orderRefundRepository->all();
        return view('admin.order_refunds.index')
            ->with('orderRefunds', $orderRefunds);
    }

    /**
     * Show the form for creating a new OrderRefund.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.order_refunds.create');
    }

    /**
     * Store a newly created OrderRefund in storage.
     *
     * @param CreateOrderRefundRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderRefundRequest $request)
    {
        $input = $request->all();

        $orderRefund = $this->orderRefundRepository->create($input);

        Flash::success('Order Refund saved successfully.');

        return redirect(route('orderRefunds.index'));
    }

    /**
     * Display the specified OrderRefund.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $orderRefund = $this->orderRefundRepository->findWithoutFail($id);

        if (empty($orderRefund)) {
            Flash::error('Order Refund not found');

            return redirect(route('orderRefunds.index'));
        }

        return view('admin.order_refunds.show')->with('orderRefund', $orderRefund);
    }

    /**
     * Show the form for editing the specified OrderRefund.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $orderRefund = $this->orderRefundRepository->findWithoutFail($id);
        $orderRefundImg=$orderRefund->images()->get();
        //dd($orderRefundImg);
        if (empty($orderRefund)) {
            Flash::error('Order Refund not found');
            return redirect(route('orderRefunds.index'));
        }
        $refundLogs = $orderRefund->logs()->orderBy('created_at', 'desc')->get();
        return view('admin.order_refunds.edit')
                ->with('orderRefund', $orderRefund)
                ->with('refundLogs', $refundLogs)
                ->with('orderRefundImg',$orderRefundImg);
    }

    /**
     * Update the specified OrderRefund in storage.
     *
     * @param  int              $id
     * @param UpdateOrderRefundRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderRefundRequest $request)
    {
        $orderRefund = $this->orderRefundRepository->findWithoutFail($id);

        if (empty($orderRefund)) {
            Flash::error('Order Refund not found');

            return redirect(route('orderRefunds.index'));
        }

        $orderRefund = $this->orderRefundRepository->update($request->all(), $id);

        Flash::success('Order Refund updated successfully.');

        return redirect(route('orderRefunds.index'));
    }

    /**
     * Remove the specified OrderRefund from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $orderRefund = $this->orderRefundRepository->findWithoutFail($id);

        if (empty($orderRefund)) {
            Flash::error('Order Refund not found');

            return redirect(route('orderRefunds.index'));
        }

        $this->orderRefundRepository->delete($id);

        Flash::success('Order Refund deleted successfully.');

        return redirect(route('orderRefunds.index'));
    }


    public function getUpdate(Request $request, $id)
    {
        $orderRefund = $this->orderRefundRepository->findWithoutFail($id);

        if (empty($orderRefund)) {
            return ['code' => 1, 'message' => '退货信息不存在'];
        }

        $inputs = $request->all();
        $orderRefund = $this->orderRefundRepository->update($inputs, $id);
        $admin = auth('admin')->user();

        app('commonRepo')->addRefundLog($admin->showName, $request->input('message'), $id);

        if (array_key_exists('status', $inputs) && $inputs['status'] == 3) {
            //执行退款操作
            $this->orderRefundRepository->returnMoeny($id);
        }

        return ['code' => 0, 'message' => '成功'];
    }

    /*
 * 上传图片
 */
    public function refundUploadImage($refunds_id){
        $file =  Input::file('file');
        $allowed_extensions = ["png", "jpg", "gif"];
       // return ['ss'=>$file];
        if(!empty($file)) {
            if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
                return ['code' => 1, 'messsage' => '图片格式不正确'];
            }
        }

        $destinationPath = 'uploads/';
        $extension = $file->getClientOriginalExtension();
        $fileName = str_random(10).'.'.$extension;
        $file->move($destinationPath, $fileName);
        $host='http://'.$_SERVER["HTTP_HOST"];

       $orderRefundImg= $this->orderRefundImageRepository->create(['url'=>$host.'/'.$destinationPath.$fileName,'order_refunds_id'=>$refunds_id]);
        return [
            'code' => '0',
            'msg' => [
                'src'=>$host.'/'.$destinationPath.$fileName,
                'orimg_id'=>$orderRefundImg->id,
                'current_time' => date('Y-m-d H:i:s')
            ]
        ];
    }

    //切换图片
    public function switchRefundUploadImage($or_id){
        $file =  Input::file('file');
        $allowed_extensions = ["png", "jpg", "gif"];
        if(!empty($file)) {
            if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
                return ['code' => 1, 'messsage' => '图片格式不正确'];
            }
        }

        $destinationPath = 'uploads/';
        $extension = $file->getClientOriginalExtension();
        $fileName = str_random(10).'.'.$extension;
        $file->move($destinationPath, $fileName);
        $host='http://'.$_SERVER["HTTP_HOST"];
        $this->orderRefundImageRepository->update(['url'=>$host.'/'.$destinationPath.$fileName],$or_id);
        return [
            'code' => '0',
            'msg' => [
                'src'=>$host.'/'.$destinationPath.$fileName,
                'orimg_id'=>$or_id,
                'current_time' => date('Y-m-d H:i:s')
            ]
        ];
    }
}
