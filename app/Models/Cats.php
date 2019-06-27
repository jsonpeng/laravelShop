<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cats
 * @package App\Models
 * @version August 15, 2018, 9:25 am CST
 *
 * @property string name
 * @property integer sort
 */
class Cats extends Model
{
    use SoftDeletes;

    public $table = 'cats';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'sort',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
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


    public function stores(){
        return $this->belongsToMany('App\Models\Store','stores_cats','cat_id','store_id');
    }

}
