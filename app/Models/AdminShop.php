<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AdminShop
 * @package App\Models
 * @version September 4, 2018, 4:11 pm CST
 *
 * @property integer admin_id
 * @property integer shop_id
 */
class AdminShop extends Model
{
    use SoftDeletes;

    public $table = 'admin_shops';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'admin_id',
        'shop_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'admin_id' => 'integer',
        'shop_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
