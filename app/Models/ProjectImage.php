<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProjectImage
 * @package App\Models
 * @version August 13, 2018, 10:51 am CST
 *
 * @property string image
 * @property integer project_id
 */
class ProjectImage extends Model
{
    use SoftDeletes;

    public $table = 'project_images';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'image',
        'project_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'image' => 'string',
        'project_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
