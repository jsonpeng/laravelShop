<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Brand
 * @package App\Models
 * @version April 28, 2017, 2:18 am UTC
 */
class Brand extends Model
{
    use SoftDeletes;

    public $table = 'brands';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'intro',
        'sort',
        'image',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'slug' => 'string',
        'intro' => 'string',
        'sort' => 'integer',
        'image' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|unique:brands',
        'slug' => 'unique'
    ];

    
}
