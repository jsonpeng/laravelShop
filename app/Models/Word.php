<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductImage
 * @package App\Models
 * @version July 25, 2017, 8:07 pm CST
 */
class Word extends Model
{
    use SoftDeletes;

    public $table = 'word';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'img'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name'=>'string',
        'img'=>'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    //文字关联的产品
    public function product(){
        return $this->belongsToMany('App\Models\Product','product_word','word_id','product_id');
    }

    
}
