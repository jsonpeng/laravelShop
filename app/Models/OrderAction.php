<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OrderAction
 * @package App\Models
 * @version January 16, 2018, 5:36 am UTC
 *
 * @property integer order_id
 * @property integer user_id
 * @property string order_status
 * @property string shipping_status
 * @property string pay_status
 * @property string action
 * @property string status_desc
 */
class OrderAction extends Model
{
    use SoftDeletes;

    public $table = 'order_actions';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'order_id',
        'user',
        'order_status',
        'shipping_status',
        'pay_status',
        'action',
        'status_desc'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'order_id' => 'integer',
        'user' => 'string',
        'order_status' => 'string',
        'shipping_status' => 'string',
        'pay_status' => 'string',
        'action' => 'string',
        'status_desc' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'order_id' => 'required',
        'user' => 'required',
        'order_status' => 'required',
        'shipping_status' => 'required',
        'pay_status' => 'required',
        'action' => 'required',
        'status_desc' => 'required'
    ];

    // 操作所属订单
    public function order(){
        return $this->belongsTo('App\Models\Order');
    }

    
}
