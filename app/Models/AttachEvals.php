<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AttachEvals
 * @package App\Models
 * @version August 17, 2018, 9:27 am CST
 *
 * @property integer eval_id
 * @property string type
 * @property string url
 */
class AttachEvals extends Model
{
    use SoftDeletes;

    public $table = 'attach_evals';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'eval_id',
        'type',
        'url'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'eval_id' => 'integer',
        'type' => 'string',
        'url' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
