<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Certs
 * @package App\Models
 * @version August 15, 2018, 6:27 pm CST
 *
 * @property string name
 * @property string id_card
 * @property string face_image
 * @property string back_image
 * @property string hand_image
 * @property integer user_id
 */
class Certs extends Model
{
    use SoftDeletes;

    public $table = 'certs';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'id_card',
        'face_image',
        'back_image',
        'hand_image',
        'status',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'id_card' => 'string',
        'face_image' => 'string',
        'back_image' => 'string',
        'hand_image' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
    
}
