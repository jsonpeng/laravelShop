<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Address
 * @package App\Models
 * @version April 28, 2017, 2:09 am UTC
 */
class Address extends Model
{
    use SoftDeletes;

    public $table = 'addresses';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'phone',
        'province',
        'city',
        'district',
        'street',
        'detail',
        'remark',
        'user_id',
        'default'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'phone' => 'string',
        'province' => 'string',
        'city' => 'string',
        'district' => 'string',
        'detail' => 'string',
        'default' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'phone' => 'required',
        'province' => 'required',
        'city' => 'required',
        'district' => 'required',
        'detail' => 'required'
    ];

    //会员订单
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
