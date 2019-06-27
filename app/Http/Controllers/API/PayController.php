<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;

use EasyWeChat\Factory;
use App\Models\Order;
use Config;
use Log;

class PayController extends Controller
{

	private $orderRepository;
    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepository = $orderRepo;
    }

    public function miniWechatPay(Request $request, $order_id)
    {
    	$order = $this->orderRepository->findWithoutFail($order_id);
    	if (empty($order)) {
    		return ['status_code' => 0, 'message' => '订单信息不存在'];
    	}

        $out_trade_no = $order->snumber.'_'.time();
        $order->out_trade_no = $out_trade_no;
        $order->save();

        $body = '支付订单'.$order->snumber.'费用';
        $user =auth()->user();

        $attributes = [
            'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
            'body'             => $body,
            'detail'           => '订单编号:'.$order->snumber,
            'out_trade_no'     => $out_trade_no,
            'total_fee'        => intval( $order->price * 100 ), // 单位：分
            'notify_url'       => $request->root().'/notify_wechcat_pay', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'openid'           => $user->openid, // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            'attach'           => '支付订单',
        ];

        //Log::info(Config::get('wechat.payment.xiaochengxu'));

        //Log::info($attributes);

        $payment = Factory::payment(Config::get('wechat.payment.xiaochengxu'));

        $result = $payment->order->unify($attributes);

        //Log::info($result);

        if ($result['return_code'] == 'SUCCESS' && $result['result_code'] == 'SUCCESS'){
            $prepayId = $result['prepay_id'];
            $json = $payment->jssdk->bridgeConfig($prepayId);

            return ['status_code' => 0, 'message' => $json];

        }else{
            return ['status_code' => 1, 'message' => $result];
        }
    }
}
