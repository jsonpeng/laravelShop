<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class GroupSale
 * @package App\Models
 * @version January 22, 2018, 9:00 am CST
 *
 * @property string name
 * @property string time_begin
 * @property string time_end
 * @property integer product_id
 * @property integer spec_id
 * @property float price
 * @property integer product_max
 * @property integer buy_num
 * @property integer order_num
 * @property integer buy_base
 * @property longtext intro
 * @property float origin_price
 * @property string product_name
 * @property integer recommend
 * @property integer view
 * @property integer is_end
 */
class GroupSale extends Model
{
    use SoftDeletes;

    public $table = 'group_sales';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'time_begin',
        'time_end',
        'product_id',
        'spec_id',
        'price',
        'product_max',
        'buy_num',
        'order_num',
        'buy_base',
        'intro',
        'origin_price',
        'product_name',
        'recommend',
        'view',
        'is_end'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'time_begin' => 'string',
        'time_end' => 'string',
        'product_id' => 'integer',
        'spec_id' => 'integer',
        'price' => 'float',
        'product_max' => 'integer',
        'buy_num' => 'integer',
        'order_num' => 'integer',
        'buy_base' => 'integer',
        'origin_price' => 'float',
        'product_name' => 'string',
        'recommend' => 'integer',
        'view' => 'integer',
        'is_end' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'price' => 'required'
    ];

    
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function spec()
    {
        return $this->belongsTo('App\Models\SpecProductPrice');
    }
}
