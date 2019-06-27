<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class KeFuFeedBack
 * @package App\Models
 * @version August 22, 2018, 5:22 pm CST
 *
 * @property string type
 * @property string content
 * @property string tel
 */
class KeFuFeedBack extends Model
{
    use SoftDeletes;

    public $table = 'ke_fu_feed_backs';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'type',
        'content',
        'tel'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'type' => 'string',
        'content' => 'string',
        'tel' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required',
        'content' => 'required',
        'tel' => 'required'
    ];

    
}
