<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\OrderRepository;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

use EasyWeChat\Factory;
use App\Models\Order;

class OrderController extends Controller
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepository = $orderRepo;
    }

    /**
     * 获取订单列表
     * @param  Request $request [description]
     * @param  integer $type    [description]
     * @return [type]           [description]
     */
    public function orders(Request $request, $type=1)
    {
        $user = auth()->user();
        $take = 18;
        if ($request->has('skip')) {
            $skip = $request->input('skip');
        }
        if ($request->has('take')) {
            $take = $request->input('take');
        }

        switch ($type) {
            case 1:
                // 全部
                $orders = $user->orders()->orderBy('created_at', 'desc')->with('items')->skip($skip)->take($take)->get();
                break;
            case 2:
                // 待付款
                $orders = $user->orders()->orderBy('created_at', 'desc')->where([
                    ['order_status', '<>', '无效'],
                    ['order_status', '<>', '已取消'],
                    ['order_pay', '=', '未支付']
                ])->with('items')->skip($skip)->take($take)->get();
                break;
            case 3:
                // 待发货
                $orders = $user->orders()->orderBy('created_at', 'desc')->where([
                    ['order_status', '<>', '无效'],
                    ['order_status', '<>', '已取消'],
                    ['order_pay', '=', '已支付'],
                    ['order_delivery', '=', '未发货']
                ])->with('items')->skip($skip)->take($take)->get();
                break;
            case 4:
                // 待确认
                $orders = $user->orders()->orderBy('created_at', 'desc')->where([
                    ['order_status', '<>', '无效'],
                    ['order_status', '<>', '已取消'],
                    ['order_pay', '=', '已支付'],
                    ['order_delivery', '=', '已发货']
                ])->with('items')->skip($skip)->take($take)->get();
                break;
            case 5:
                // 退换货
                $orders = $user->orders()
                    ->orderBy('created_at', 'desc')
                    ->where('order_status', '无效')
                    ->orWhere('order_status', '已取消')
                    ->orWhere(function ($query) {
                        $query->where('order_pay', '已支付')
                            ->where('order_delivery', '已收货');
                    })->with('items')->skip($skip)->take($take)->get();
                break;
            default:
                # code...
                $orders = $user->orders()->orderBy('created_at', 'desc')->skip($skip)->take($take)->get();
                break;
        }

        $orders = $orders->each(function ($order, $key) {
            $order['status'] = $order->status;
            $items = $order->items;
            $count = 0;
            foreach ($items as $key => $item) {
                $count += $item['count'];
            }
            $order['count'] = $count;
        });
        return ['status_code' => 0, 'data' => $orders];
    }

    /**
     * 订单详情
     * @param  Request $request [description]
     * @param  [type]  $id      [订单编号]
     * @return [type]           [description]
     */
    public function detail(Request $request, $id)
    {
        $order = $this->orderRepository->findWithoutFail($id);
        $items = $order->items;
        return ['status_code' => 0, 'data' => ['order' => $order, 'items' => $items]];
    }

    /**
     * 保存订单
     * @param  Request $request [description]
     *  customer_name:
        customer_phone:
        customer_address:
        freight:
        address_id:
        coupon_id:
        credits:
        user_money_pay:
        prom_type:
        prom_id:
        remark:
     * @return [type]           [description]
     * 
     */
    public function create(Request $request)
    {
        try {
            //当前用户
            $user = auth()->user();

            //订单信息
            $inputs = $request->all();

            $items = json_decode($inputs['items'], true);

            $result = $this->orderRepository->createOrder($user, $items, $inputs);

            return ['status_code'=>$result['code'], 'data' => $result['data']];

        } catch (Exception $e) {

        }
    
    }

    /**
     * 取消订单
     * @param  Request $request [description]
     * @param  [int,string]     $id,$reason      [订单id,取消原因]
     * @return [type]           [description]
     */
    public function cancel(Request $request,$id){
        $user = auth()->user();
        return $this->orderRepository->cancelOrder($id, $request->input('reason'), $user->nickname);
    }

    /**
     * 查询物流
     * @param  [string]    $company    [物流公司名称]
     * @param  [string]    $number     [运单号]
     * @param  [integer]   $muti       [0单行还是1所有]
     * @param  [string]    $sort       [desc默认倒序]
     * @return [json]                  [返回数据集合]
     */
    public function getLogicInfo(Request $request){
        $company=$request->input('company');
        $number=$request->input('number');
        $muti=empty($request->input('muti')) ? 0 : $request->input('muti');
        $sort=empty($request->input('sort')) ? 'desc' : $request->input('sort');
        $data=app('commonRepo')->orderRepo()->getLogicInfo($company,$number,$muti,$sort);
        return $data;
        //return ['status_code'=>0,'data'=> $data];
    }

}
