<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OrderCancelImage
 * @package App\Models
 * @version February 7, 2018, 4:17 pm CST
 *
 * @property string url
 * @property integer order_cancel_id
 */
class OrderCancelImage extends Model
{
    use SoftDeletes;

    public $table = 'order_cancel_images';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'url',
        'order_cancel_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'url' => 'string',
        'order_cancel_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
