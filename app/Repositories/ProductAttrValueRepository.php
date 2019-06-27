<?php

namespace App\Repositories;

use App\Models\ProductAttrValue;
use InfyOm\Generator\Common\BaseRepository;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use DB;

/**
 * Class ProductAttrValueRepository
 * @package App\Repositories
 * @version January 10, 2018, 8:21 am UTC
 *
 * @method ProductAttrValue findWithoutFail($id, $columns = ['*'])
 * @method ProductAttrValue find($id, $columns = ['*'])
 * @method ProductAttrValue first($columns = ['*'])
*/
class ProductAttrValueRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'attr_id',
        'attr_value'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProductAttrValue::class;
    }

    //获取属性信息 单条
    public function getProductAttrVal($id = 0 ,$product_id = 0, $attr_id = 0)
    {    
        if($id > 0)
            return ProductAttrValue::where('id', $id)->first();
        if($product_id > 0 && $attr_id > 0)
            return ProductAttrValue::where('product_id', $product_id)->where('attr_id', $attr_id)->first();
    }


    public function getAllAttrOfProduct($product_id)
    {
        /*
        $attrs = ProductAttrValue::where('product_id', $product_id)->get();
        $attrArray = [];
        foreach ($attrs as $attr) {
            $tmp = \App\Models\ProductAttr::where('id', $attr->attr_id)->first();
            if (!empty($tmp)) {
                array_push($attrArray, ['name' => $tmp->name, 'value' => $attr->attr_value]);
            }
        }
        */
        $attrArray = DB::table('product_attr_values')
            ->join('product_attrs', 'product_attr_values.attr_id', '=', 'product_attrs.id')
            ->select('product_attrs.name as name', 'product_attr_values.attr_value as value')
            ->where('product_attr_values.product_id', $product_id)
            ->get();
        return $attrArray;
    }

    public function getAllAttrOfProductCached($product_id)
    {
        return Cache::remember('getAllAttrOfProductCached'.$product_id, Config::get('web.cachetime'), function() use($product_id){
            return $this->getAllAttrOfProduct($product_id);
        });
    }


    
}
