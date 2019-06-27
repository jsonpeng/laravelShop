<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CustomerService
 * @package App\Models
 * @version February 27, 2018, 5:21 pm CST
 *
 * @property string name
 * @property string platform
 * @property string job
 * @property string head_img
 * @property string qr_code
 * @property string commit
 */
class CustomerService extends Model
{
    use SoftDeletes;

    public $table = 'customer_services';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'platform',
        'job',
        'head_img',
        'qr_code',
        'commit',
        'show'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'platform' => 'string',
        'job' => 'string',
        'head_img' => 'string',
        'qr_code' => 'string',
        'commit' => 'string',
        'show'=>'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    public function getPlatformsAttribute(){
      return Config::get('serviceplateform')[$this->platform];
    }

    public function getJobsAttribute(){
        return Config::get('servicejob')[$this->job];
    }
    public function getWhetherShowAttribute(){
        return $this->show==1?'是':'否';
    }


    
}
