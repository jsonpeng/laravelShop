<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OrderRefund
 * @package App\Models
 * @version February 7, 2018, 4:25 pm CST
 *
 * @property integer item_id
 * @property integer order_id
 * @property integer user_id
 * @property integer type
 * @property string reason
 * @property string describe
 * @property integer status
 * @property string remark
 * @property string seller_delivery_company
 * @property string seller_delivery_no
 * @property float refund_money
 * @property float refund_deposit
 * @property integer refund_credit
 * @property integer refund_type
 * @property string refund_time
 * @property integer is_receive
 * @property integer return_status
 * @property string return_delivery_company
 * @property string return_delivery_no
 * @property float return_delivery_money
 */
class OrderRefund extends Model
{
    use SoftDeletes;

    public $table = 'order_refunds';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'item_id',
        'order_id',
        'user_id',
        'count',
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'item_id' => 'integer',
        'order_id' => 'integer',
        'user_id' => 'integer',
        'type' => 'integer',
        'reason' => 'string',
        'describe' => 'string',
        'status' => 'integer',
        'remark' => 'string',
        'seller_delivery_company' => 'string',
        'seller_delivery_no' => 'string',
        'refund_money' => 'float',
        'refund_deposit' => 'float',
        'refund_credit' => 'integer',
        'refund_type' => 'integer',
        'refund_time' => 'string',
        'is_receive' => 'integer',
        'return_status' => 'integer',
        'return_delivery_company' => 'string',
        'return_delivery_no' => 'string',
        'return_delivery_money' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];

    public function item(){
        return $this->belongsTo('App\Models\Item');
    }

    public function order(){
        return $this->belongsTo('App\Models\Order');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function logs(){
        return $this->hasMany('App\Models\RefundLog', 'order_refund_id', 'id');
    }

    public function getTypeStringAttribute()
    {
        if ($this->type == 0){
            return '退款';
        }
        if ($this->type == 1){
            return '退货退款';
        }
        if ($this->type == 2){
            return '换货';
        }
    }

    public function getStatusStringAttribute()
    {
        if ($this->status == -2){
            return '用户取消';
        }
        if ($this->status == -1){
            return '审核不通过';
        }
        if ($this->status == 0){
            return '待审核';
        }
        if ($this->status == 1){
            return '审核通过';
        }
        if ($this->status == 2){
            return '已发货';
        }
        if ($this->status == 3){
            return '已完成';
        } 
    }

    public function getRefundTypeStringAttribute()
    {
        if ($this->refund_type == 0){
            return '原路返回';
        }
        if ($this->refund_type == 1){
            return '退款到余额';
        }
    }

    public function getIsReceiveStringAttribute()
    {
        if ($this->is_receive == 0){
            return '未收到';
        }
        if ($this->is_receive == 1){
            return '收到';
        }
    }


    public function getRefundStatusAttribute()
    {
        if ($this->status == -2){
            return '已取消';
        }

        if ($this->status == -1){
            return '未通过审核';
        }

        if ($this->status == 0){
            return '待审核';
        }


        if ($this->status == 1){
            if($this->type == 0){
                return '待退款';
            }else if ($this->type == 1) {
                //需要寄回货物
                if ($this->return_status == 0){
                    //买家未发货
                    return '等待买家发货';
                }
                else if ($this->return_status == 1){
                    //买家已发货
                    return '买家已发货';
                }
                else if ($this->return_status == 2){
                    return '待商家退款';
                }
            }else{
                //需要寄回货物
                if ($this->return_status == 0){
                    return '待买家发货';
                }
                else if ($this->return_status == 1){
                    return '买家已发货';
                }
                else{
                    return '待商家重新发货';
                }
            }
        }
            
        if ($this->status == 2){
            return '卖家已重新发货';
        }

        if ($this->status == 3){
            return '已完成';
        }
        
    }

    //对应的图片
    public function images()
    {
        return $this->hasMany('App\Models\OrderRefundImage', 'order_refunds_id', 'id');
    }

}
