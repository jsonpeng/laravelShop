<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductAttrValue
 * @package App\Models
 * @version January 10, 2018, 8:21 am UTC
 *
 * @property integer product_id
 * @property integer attr_id
 * @property string attr_value
 */
class ProductAttrValue extends Model
{
    use SoftDeletes;

    public $table = 'product_attr_values';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'product_id',
        'attr_id',
        'attr_value'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'product_id' => 'integer',
        'attr_id' => 'integer',
        'attr_value' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function attr()
    {
        return $this->belongsTo('App\Models\ProductAttr');
    }
}
