<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\SpecItem;

/**
 * Class Spec
 * @package App\Models
 * @version January 7, 2018, 4:47 am UTC
 *
 * @property string name
 * @property integer sort
 * @property integer type_id
 */
class Spec extends Model
{
    use SoftDeletes;

    public $table = 'specs';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'sort',
        'type_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'sort' => 'integer',
        'type_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    public function selections()
    {
        $specItems = SpecItem::where('spec_id', $this->id)->get();
        $selections = '';
        foreach ($specItems as $specItem) {
            $selections .= $specItem->name;
            $selections .= "\r\n";
        }
        return $selections;
    }

    public function items()
    {
        return $this->hasMany('App\Models\SpecItem', 'spec_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\ProductType', 'type_id', 'id');
    }

    public function getSelectItemsAttribute($value='')
    {
        $specItems = SpecItem::where('spec_id', $this->id)->get();
        $selections = '';
        foreach ($specItems as $specItem) {
            $selections .= $specItem->name;
            $selections .= " ";
        }
        return $selections;
    }
}
