<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OrderCancel
 * @package App\Models
 * @version February 7, 2018, 2:06 pm CST
 *
 * @property integer order_id
 * @property string reason
 * @property float money
 * @property integer auth
 * @property integer refound
 * @property string remark
 */
class OrderCancel extends Model
{
    use SoftDeletes;

    public $table = 'order_cancels';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'order_id',
        'reason',
        'money',
        'user_money',
        'credits',
        'auth',
        'refound',
        'remark'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'order_id' => 'integer',
        'reason' => 'string',
        'money' => 'float',
        'auth' => 'integer',
        'refound' => 'integer',
        'remark' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function order()
    {
        $this->belongsTo('App\Models\Order', 'order_id', 'id');
    }

    public function getAuthStatusAttribute()
    {
        if ($this->auth == 0) {
            return '待审核';
        } else if ($this->auth == 1){
            return '审核通过';
        }else{
            return '审核未通过';
        }
    }

    public function getRefoundStatusAttribute()
    {
        if ($this->refound == 0) {
            return '原路返回';
        }else{
            return '返回到余额';
        }
    }
}