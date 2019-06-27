<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductAttr
 * @package App\Models
 * @version January 7, 2018, 5:06 am UTC
 *
 * @property string name
 * @property integer isIndex
 * @property integer input_type
 * @property string values
 * @property integer sort
 */
class ProductAttr extends Model
{
    use SoftDeletes;

    public $table = 'product_attrs';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'isIndex',
        'input_type',
        'values',
        'sort',
        'type_id',
        'attr_type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'isIndex' => 'string',
        'input_type' => 'integer',
        'values' => 'string',
        'sort' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    public function type()
    {
        return $this->belongsTo('App\Models\ProductType', 'type_id', 'id');
    }
}
