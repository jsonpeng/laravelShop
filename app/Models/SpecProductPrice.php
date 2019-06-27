<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SpecProductPrice
 * @package App\Models
 * @version January 9, 2018, 11:05 am UTC
 *
 * @property string key
 * @property string key_name
 * @property float price
 * @property integer inventory
 * @property string qrcode
 * @property string sku
 * @property string image
 * @property integer prom_id
 * @property integer prom_type
 */
class SpecProductPrice extends Model
{
    use SoftDeletes;

    public $table = 'spec_product_prices';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'key',
        'key_name',
        'price',
        'inventory',
        'qrcode',
        'sku',
        'image',
        'prom_id',
        'prom_type',
        'product_id',
        'jifen'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'key' => 'string',
        'key_name' => 'string',
        'price' => 'float',
        'inventory' => 'integer',
        'qrcode' => 'string',
        'sku' => 'string',
        'image' => 'string',
        'prom_id' => 'integer',
        'prom_type' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'key' => 'required',
        'key_name' => 'required',
        'price' => 'required',
        'inventory' => 'required'
    ];

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
    
}
