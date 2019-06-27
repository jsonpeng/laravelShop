<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductEval
 * @package App\Models
 * @version August 17, 2018, 9:15 am CST
 *
 * @property string content
 * @property integer user_id
 * @property integer product_id
 * @property integer anonymous
 * @property integer all_level
 * @property integer service_level
 * @property integer logistics_level
 * @property integer overall_level
 * @property integer spec_id
 */
class ProductEval extends Model
{
    use SoftDeletes;

    public $table = 'product_evals';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'content',
        'user_id',
        'product_id',
        'anonymous',
        'all_level',
        'service_level',
        'logistics_level',
        'overall_level',
        'spec_id',
        'zan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'content' => 'string',
        'user_id' => 'integer',
        'product_id' => 'integer',
        'anonymous' => 'integer',
        'all_level' => 'integer',
        'service_level' => 'integer',
        'logistics_level' => 'integer',
        'overall_level' => 'integer',
        'spec_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
         'all_level' => 'required',
         'service_level' => 'required',
         'logistics_level' => 'required',
         'overall_level' => 'required',
    ];

    #评价附加文件
    public function attach(){
        return $this->hasMany('App\Models\AttachEvals','eval_id','id');
    }

    #评价的商品
    public function product(){
        return $this->belongsTo('App\Models\Product','product_id','id');
    }

    #评价的商品规格
    public function spec(){
        return $this->belongsTo('App\Models\SpecProductPrice','spec_id','id');
    }

    #商品名称
    public function getproductNameAttribute()
    {
        $product_name =  optional($this->product)->name;

        $spec_name = optional($this->spec)->key_name;
        
        if(!empty($spec_name))
        {
            $product_name = $spec_name;
        }
        return $product_name;
    }

    #商品发布人名称
    public function getuserNameAttribute()
    {
        return optional($this->publisher)->nickname;
    }

    #评价的发布者
    public function publisher(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
