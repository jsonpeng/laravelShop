<?php

namespace App\Repositories;

use App\Models\OrderRefund;
use InfyOm\Generator\Common\BaseRepository;


use App\User;
use Auth;
use App\Models\RefundMoney;
use EasyWeChat\Factory;
use Config;

/**
 * Class OrderRefundRepository
 * @package App\Repositories
 * @version February 7, 2018, 4:25 pm CST
 *
 * @method OrderRefund findWithoutFail($id, $columns = ['*'])
 * @method OrderRefund find($id, $columns = ['*'])
 * @method OrderRefund first($columns = ['*'])
*/
class OrderRefundRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'item_id',
        'order_id',
        'user_id',
        'type',
        'reason',
        'describe',
        'status',
        'remark',
        'seller_delivery_company',
        'seller_delivery_no',
        'refund_money',
        'refund_deposit',
        'refund_credit',
        'refund_type',
        'refund_time',
        'is_receive',
        'return_status',
        'return_delivery_company',
        'return_delivery_no',
        'return_delivery_money'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return OrderRefund::class;
    }

    /**
     * 退款
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function returnMoeny($id)
    {
        $orderRefund = $this->findWithoutFail($id);
        $admin = auth('admin')->user();
        if (empty($orderRefund)) {
            app('commonRepo')->addRefundLog($admin->showName, '退款操作失败，退款申请记录不存在', $id);
            return;
        }
        $order = $orderRefund->order;
        if (empty($order)) {
            app('commonRepo')->addRefundLog($admin->showName, '退款操作失败，订单信息不存在', $id);
            return;
        }
        $user = User::where('id', $order->user_id)->first();
        if (empty($user)) {
            app('commonRepo')->addRefundLog($admin->showName, '退款操作失败，退款用户不存在', $id);
            return;
        }
        if ($orderRefund->refund_type == 0) {
            //原路返回
            if ($orderRefund->refund_money) {
                $payment = Factory::payment(Config::get('wechat.payment.default'));
                // 参数分别为：商户订单号、商户退款单号、订单金额、退款金额、其他参数
                $result = $payment->refund->byOutTradeNumber($order->snumber, $order->snumber.'refund', $order->price, $orderRefund->refund_money, [
                    'refund_desc' => '订单取消退款',
                ]);
            }

            $user->user_money += $orderRefund->refund_deposit;
            $user->credits += $orderRefund->refund_credit;
            $user->save();
            if ($orderRefund->refund_deposit > 0) {
                app('commonRepo')->addMoneyLog($user->user_money, $orderRefund->refund_deposit, '退款到余额,退换货单号为'.$orderRefund->id, 0, $user->id);
            }
            if ($orderRefund->refund_credit > 0) {
                app('commonRepo')->addCreditLog($user->credits, $orderRefund->refund_credit, '退还'.getSettingValueByKeyCache('credits_alias').',退换货单号为'.$orderRefund->id, 0, $user->id);
            }
        } else {
            //退还到余额
            $user->user_money += $orderRefund->refund_money;
            $user->user_money += $orderRefund->refund_deposit;
            $user->credits += $orderRefund->refund_credit;
            $user->save();
            if ($orderRefund->refund_money + $orderRefund->refund_deposit > 0) {
                app('commonRepo')->addMoneyLog($user->user_money, $orderRefund->refund_money + $orderRefund->refund_deposit, '退款到余额,退换货单号为'.$orderRefund->id, 0, $user->id);
            }
            if ($orderRefund->refund_credit > 0) {
                app('commonRepo')->addCreditLog($user->credits, $orderRefund->refund_credit, '退还'.getSettingValueByKeyCache('credits_alias').',退换货单号为'.$orderRefund->id, 0, $user->id);
            }
        }
        
    }

    public function getProgressArray($id)
    {
        $orderRefund = $this->findWithoutFail($id);
        if (empty($orderRefund)) {
            return [
                'list' => [],
                'cur' => ''
            ];
        }
        if ($orderRefund->status == -2){
            return [
                'list' => ['提交申请', '用户取消'],
                'cur' => '用户取消'
            ];
        }

        if ($orderRefund->status == -1){
            return [
                'list' => ['提交申请', '商城审核', '审核不通过'],
                'cur' => '审核不通过'
            ];
        }

        if ($orderRefund->status == 0){
            if($orderRefund->type == 0){
                return [
                    'list' => ['提交申请', '商城审核', '完成退款'],
                    'cur' => '提交申请'
                ];
            }else if ($orderRefund->type == 1) {
                //需要寄回货物
                if ($orderRefund->return_status == 0){
                    //买家未发货
                    return [
                        'list' => ['提交申请', '商城审核', '用户已发货', '卖家已收货', '完成退款'],
                        'cur' => '提交申请'
                    ];
                }
                else if ($orderRefund->return_status == 1){
                    //买家已发货
                    return [
                        'list' => ['提交申请', '商城审核', '用户已发货', '卖家已收货', '完成退款'],
                        'cur' => '提交申请'
                    ];
                }
                else if ($orderRefund->return_status == 2){
                    //买家已发货
                    return [
                        'list' => ['提交申请', '商城审核', '用户已发货', '卖家已收货', '完成退款'],
                        'cur' => '提交申请'
                    ];
                }
            }else{
                //需要寄回货物
                if ($orderRefund->is_receive == 0) {
                    //没收到货
                    if ($orderRefund->return_status == 0){
                        return [
                            'list' => ['提交申请', '商城审核', '卖家已发货'],
                            'cur' => '提交申请'
                        ];
                    }
                    else if ($orderRefund->return_status == 1){
                        return [
                            'list' => ['提交申请', '商城审核', '卖家已发货'],
                            'cur' => '提交申请'
                        ];
                    }
                    else{
                        return [
                            'list' => ['提交申请', '商城审核', '卖家已发货'],
                            'cur' => '提交申请'
                        ];
                    }
                }else{
                    if ($orderRefund->return_status == 0){
                        return [
                            'list' => ['提交申请', '商城审核', '用户已发货', '卖家已收货', '卖家已发货'],
                            'cur' => '提交申请'
                        ];
                    }
                    else if ($orderRefund->return_status == 1){
                        return [
                            'list' => ['提交申请', '商城审核', '用户已发货', '卖家已收货', '卖家已发货'],
                            'cur' => '提交申请'
                        ];
                    }
                    else{
                        return [
                            'list' => ['提交申请', '商城审核', '用户已发货', '卖家已收货', '卖家已发货'],
                            'cur' => '提交申请'
                        ];
                    }
                }
                
            }
        }


        if ($orderRefund->status == 1){
            if($orderRefund->type == 0){
                return [
                    'list' => ['提交申请', '商城审核', '完成退款'],
                    'cur' => '商城审核'
                ];
            }else if ($orderRefund->type == 1) {
                //需要寄回货物
                if ($orderRefund->return_status == 0){
                    //买家未发货
                    return [
                        'list' => ['提交申请', '商城审核', '用户已发货', '卖家已收货', '完成退款'],
                        'cur' => '商城审核'
                    ];
                }
                else if ($orderRefund->return_status == 1){
                    //买家已发货
                    return [
                        'list' => ['提交申请', '商城审核', '用户已发货', '卖家已收货', '完成退款'],
                        'cur' => '用户已发货'
                    ];
                }
                else if ($orderRefund->return_status == 2){
                    //买家已发货
                    return [
                        'list' => ['提交申请', '商城审核', '用户已发货', '卖家已收货', '完成退款'],
                        'cur' => '卖家已收货'
                    ];
                }
            }else{
                //需要寄回货物
                if ($orderRefund->is_receive == 0) {
                    //没收到货
                    if ($orderRefund->return_status == 0){
                        return [
                            'list' => ['提交申请', '商城审核', '卖家已发货'],
                            'cur' => '商城审核'
                        ];
                    }
                    else if ($orderRefund->return_status == 1){
                        return [
                            'list' => ['提交申请', '商城审核', '卖家已发货'],
                            'cur' => '用户已发货'
                        ];
                    }
                    else{
                        return [
                            'list' => ['提交申请', '商城审核', '卖家已发货'],
                            'cur' => '卖家已收货'
                        ];
                    }
                } else {
                    //收到货
                    if ($orderRefund->return_status == 0){
                        return [
                            'list' => ['提交申请', '商城审核', '用户已发货', '卖家已收货', '卖家已发货'],
                            'cur' => '商城审核'
                        ];
                    }
                    else if ($orderRefund->return_status == 1){
                        return [
                            'list' => ['提交申请', '商城审核', '用户已发货', '卖家已收货', '卖家已发货'],
                            'cur' => '用户已发货'
                        ];
                    }
                    else{
                        return [
                            'list' => ['提交申请', '商城审核', '用户已发货', '卖家已收货', '卖家已发货'],
                            'cur' => '卖家已收货'
                        ];
                    }
                }
                
                
            }
        }
            
        if ($orderRefund->status == 2){
            if ($orderRefund->is_receive == 0) {
                //没收到货
                return [
                    'list' => ['提交申请', '商城审核', '卖家已发货'],
                    'cur' => '卖家已发货'
                ];
            }else{
                return [
                    'list' => ['提交申请', '商城审核', '用户已发货', '卖家已收货', '卖家已发货'],
                    'cur' => '卖家已发货'
                ];
            }
            
        }

        if ($orderRefund->status == 3){
            if($orderRefund->type == 0){
                return [
                    'list' => ['提交申请', '商城审核', '完成退款'],
                    'cur' => '完成退款'
                ];
            }else if ($orderRefund->type == 1) {
                //需要寄回货物
                if ($orderRefund->is_receive == 0) {
                    //没收到货
                    return [
                        'list' => ['提交申请', '商城审核', '完成退款'],
                        'cur' => '完成退款'
                    ];
                }else{
                    return [
                        'list' => ['提交申请', '商城审核', '用户已发货', '卖家已收货', '完成退款'],
                        'cur' => '完成退款'
                    ];
                }
                
            }else{
                //需要寄回货物
                if ($orderRefund->is_receive == 0) {
                    //没收到货
                    return [
                        'list' => ['提交申请', '商城审核', '卖家已发货'],
                        'cur' => '卖家已发货'
                    ];
                }else{
                    return [
                        'list' => ['提交申请', '商城审核', '用户已发货', '卖家已收货', '卖家已发货'],
                        'cur' => '卖家已发货'
                    ];
                }
            }
        }
    }
}
