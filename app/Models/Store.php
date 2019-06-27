<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Store
 * @package App\Models
 * @version August 11, 2018, 2:04 pm CST
 *
 * @property string name
 * @property string image
 * @property float jindu
 * @property float weidu
 * @property string address
 */
class Store extends Model
{
    use SoftDeletes;

    public $table = 'stores';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'image',
        'jindu',
        'weidu',
        'address',
        'mobile',
        'sort'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'image' => 'string',
        'address' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'address' => 'required'
    ];

    public function products(){
         return $this->belongsToMany('App\Models\Product', 'stores_products', 'store_id','product_id');
    }

    public function cats(){
        return $this->belongsToMany('App\Models\Cats','stores_cats','store_id','cat_id');
    }

    
}
