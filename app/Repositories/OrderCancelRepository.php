<?php

namespace App\Repositories;

use App\Models\OrderCancel;
use InfyOm\Generator\Common\BaseRepository;

use Auth;
use Config;
use App\User;
use App\Models\RefundMoney;
use EasyWeChat\Factory;
use App\Models\CouponUser;
use App\Models\Order;

/**
 * Class OrderCancelRepository
 * @package App\Repositories
 * @version February 7, 2018, 2:06 pm CST
 *
 * @method OrderCancel findWithoutFail($id, $columns = ['*'])
 * @method OrderCancel find($id, $columns = ['*'])
 * @method OrderCancel first($columns = ['*'])
*/
class OrderCancelRepository extends BaseRepository
{


    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order_id',
        'reason',
        'money',
        'auth',
        'refound',
        'remark'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return OrderCancel::class;
    }

    /**
     * 退款
     * @param  [type] $id [description]
     * @return [type]     [description]
     */

    public function returnMoeny($id)
    {
        $orderCancel = $this->findWithoutFail($id);
        $admin = auth('admin')->user();
        if (empty($orderCancel)) {
            app('commonRepo')->addRefundLog($admin->showName, '退款操作失败，退款申请记录不存在', $id);
            return;
        }
        $order = Order::where('id', $orderCancel->order_id)->first();
        $order = null;
        if (empty($order)) {
            app('commonRepo')->addRefundLog($admin->showName, '退款操作失败，订单信息不存在', $id);
            return;
        }
        $user = User::where('id', $order->user_id)->first();
        if (empty($user)) {
            app('commonRepo')->addRefundLog($admin->showName, '退款操作失败，退款用户不存在', $id);
            return;
        }

        //取消订单则退还优惠券
        CouponUser::where('order_id', $order->id)->update(['status' => 0]);

        //退还积分
        if ($orderCancel->credits > 0) {
            app('commonRepo')->addCreditLog($user->credits, $orderCancel->credits, '退还'.getSettingValueByKeyCache('credits_alias').',退换货单号为'.$orderCancel->id, 0, $user->id);
        }

        //退还支付金额及账户余额
        if ($order->pay_platform == '管理员操作' || $order->order_pay == '未支付') {
            # 须是通过在线支付的形式付款, 人为确认支付的则不退钱
            return;
        }
        # 一个订单不能重复提交退款
        if ( RefundMoney::where('order_id', $order->id)->count() ) {
            return;
        }

        # 进入退款操作
        if ($orderCancel->refund_type == 0) {
            //原路返回
            $refundMoney = RefundMoney::create([
                'snumber' => $order->snumber,
                'transaction_id' => $order->pay_no,
                'platform' => $order->pay_platform,
                'total_fee' => $order->price,
                'snumber_refund' => 'refun_'.time(),
                'refund_fee' => $orderCancel->money,
                'desc' => '用户取消订单:'.$order->id,
                'status' => '已提交',
                'remark' => '无',
                'order_type' => '取消订单',
                'order_id' => $order->id
            ]);

            if ($order->pay_platform == '微信支付') {
                //向微信发起退款请求
                $payment = Factory::payment(Config::get('wechat.payment.default'));
                // 参数分别为：商户订单号、商户退款单号、订单金额、退款金额、其他参数
                $result = $payment->refund->byOutTradeNumber($refundMoney->snumber, $refundMoney->snumber_refund , $refundMoney->total_fee, $refundMoney->refund_fee, [
                    // 可在此处传入其他参数，详细参数见微信支付文档
                    'refund_desc' => $refundMoney->desc,
                ]);
            }

            $user->user_money += $orderCancel->user_money;
            $user->credits += $orderCancel->credits;
            $user->save();
            if ($orderCancel->user_money > 0) {
                app('commonRepo')->addMoneyLog($user->user_money, $orderCancel->user_money, '退款到余额,退换货单号为'.$orderCancel->id, 0, $user->id);
            }
        } else {
            //退还到余额
            $user->user_money += $orderCancel->money;
            $user->user_money += $orderCancel->user_money;
            $user->credits += $orderCancel->credits;
            $user->save();
            if ($orderCancel->money + $orderCancel->user_money > 0) {
                app('commonRepo')->addMoneyLog($user->user_money, $orderCancel->money + $orderCancel->user_money, '退款到余额,退换货单号为'.$orderCancel->id, 0, $user->id);
            }
        }

    }
}
