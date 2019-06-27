<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RefundMoney
 * @package App\Models
 * @version February 12, 2018, 10:55 am CST
 *
 * @property string snumber
 * @property string transaction_id
 * @property float total_fee
 * @property float refund_fee
 * @property string desc
 * @property string status
 * @property string last_query
 * @property string remark
 */
class RefundMoney extends Model
{
    use SoftDeletes;

    public $table = 'refund_moneys';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'snumber',
        'transaction_id',
        'platform',
        'total_fee',
        'snumber_refund',
        'refund_fee',
        'desc',
        'status',
        'last_query',
        'remark',
        'order_type',
        'order_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'snumber' => 'string',
        'transaction_id' => 'string',
        'total_fee' => 'float',
        'refund_fee' => 'float',
        'desc' => 'string',
        'status' => 'string',
        'last_query' => 'string',
        'remark' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
