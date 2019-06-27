<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/23
 * Time: 15:59
 */

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductImage
 * @package App\Models
 * @version July 25, 2017, 8:07 pm CST
 */
class OrderRefundImage extends Model
{
    //use SoftDeletes;

    public $table = 'order_refunds_img';


   // protected $dates = ['deleted_at'];


    public $fillable = [
        'url',
        'order_refunds_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'url' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    //图片关联的refunds
    public function refunds()
    {
        return $this->belongsTo('App\Models\OrderRefund');
    }

}