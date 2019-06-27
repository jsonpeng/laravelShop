<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FreightTem
 * @package App\Models
 * @version February 9, 2018, 5:10 pm CST
 *
 * @property string name
 * @property integer use_default
 */
class FreightTem extends Model
{
    use SoftDeletes;

    public $table = 'freight_tems';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'count_type',
        'use_default'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'count_type'=>'integer',
        'use_default' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => ' required'
    ];

    //加入的地区
    public function cities()
    {
        return $this->belongsToMany('App\Models\Cities','cities_freights','freights_id','cities_id')->withPivot('freight_type','freight_first_count','the_freight','freight_continue_count','freight_continue_price');
    }

    public function getTypeAttribute(){
        return varifyFreightTypeByTypeId($this->count_type);
    }

    public function getSystemDefaultAttribute(){
        return $this->use_default==0?'否':'是';
    }

    public function getCitiesHtmlAttribute(){
        $cities=$this->cities()->get();
        if(!empty($cities)){
            $str='';
            foreach ($cities as $item){
                $str .="<a href='javascript:;' onclick='showFreightTemList(".$item->id.")'>".$item->name."</a>&nbsp;&nbsp;";
            }
            return $str;
        }else{
            return '无';
        }
    }

}
