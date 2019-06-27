<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Card
 * @package App\Models
 * @version August 15, 2018, 3:43 pm CST
 *
 * @property string number
 * @property string password
 * @property float price
 * @property float num
 * @property integer status
 */
class Card extends Model
{
    use SoftDeletes;

    public $table = 'cards';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'number',
        'password',
        'price',
        'num',
        'status',
        'length'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'number' => 'string',
        'password' => 'string',
        'price' => 'float',
        'num' => 'float',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'num'   => 'required'
    ];

    
}
