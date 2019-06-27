<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Theme
 * @package App\Models
 * @version August 2, 2017, 2:27 pm CST
 */
class Theme extends Model
{
    use SoftDeletes;

    public $table = 'themes';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'subtitle',
        'cover',
        'intro'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'subtitle' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'subtitle' => 'required',
        'cover' => 'required',
        'intro' => 'required'
    ];

    //收藏该商品的用户
    public function products(){
        return $this->belongsToMany('App\Models\Product', 'product_theme', 'theme_id', 'product_id');
    }
}
