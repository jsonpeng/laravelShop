<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Projects
 * @package App\Models
 * @version August 13, 2018, 10:14 am CST
 *
 * @property string name
 * @property string mobile
 * @property string weixin_qq
 * @property string address
 * @property string content
 * @property double jindu
 * @property double weidu
 */
class Projects extends Model
{
    use SoftDeletes;

    public $table = 'projects';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'mobile',
        'weixin_qq',
        'address',
        'content',
        'jindu',
        'weidu'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'mobile' => 'string',
        'weixin_qq' => 'string',
        'address' => 'string',
        'content' => 'string',
        'jindu' => 'double',
        'weidu' => 'double'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'mobile' => 'required',
        'weixin_qq' => 'required',
        'address' => 'required',
        'content' => 'required',
    ];

    public function images(){
        return $this->hasMany('App\Models\ProjectImage','project_id','id');
    }
}
