<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RefundLog
 * @package App\Models
 * @version February 8, 2018, 5:25 pm CST
 *
 * @property string name
 * @property string des
 * @property string time
 */
class RefundLog extends Model
{
    use SoftDeletes;

    public $table = 'refund_logs';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'des',
        'time',
        'order_refund_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'des' => 'string',
        'time' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
