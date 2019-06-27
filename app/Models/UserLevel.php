<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserLevel
 * @package App\Models
 * @version January 6, 2018, 2:33 am UTC
 *
 * @property string name
 * @property integer amount
 * @property integer discount
 * @property string discribe
 */
class UserLevel extends Model
{
    use SoftDeletes;

    public $table = 'user_levels';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'amount',
        'discount',
        'discribe'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'amount' => 'integer',
        'discount' => 'integer',
        'discribe' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'amount' => 'required',
        'discount' => 'required'
    ];

    
}
