<?php

namespace App\Repositories;

use App\Models\ProductEval;
use App\Models\AttachEvals;
use App\Models\Item;
use InfyOm\Generator\Common\BaseRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

/**
 * Class ProductEvalRepository
 * @package App\Repositories
 * @version August 17, 2018, 9:15 am CST
 *
 * @method ProductEval findWithoutFail($id, $columns = ['*'])
 * @method ProductEval find($id, $columns = ['*'])
 * @method ProductEval first($columns = ['*'])
*/
class ProductEvalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content',
        'user_id',
        'product_id',
        'anonymous',
        'all_level',
        'service_level',
        'logistics_level',
        'overall_level',
        'spec_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProductEval::class;
    }

    /**
     * [对应商品的评价]
     * @param  [type] $product_id [description]
     * @return [type]             [description]
     */
    public function productEval($product_id){
        return Cache::remember('zcjy_productEval_'.$product_id, Config::get('web.cachetime'), function() use($product_id){
                return ProductEval::where('product_id',$product_id)
                    ->with('publisher')
                    ->with('attach')
                    ->with('product')
                    ->with('spec')
                    ->orderBy('created_at','desc')
                    ->get();
        });
    }
   

    /**
     * [对应用户的评价]
     * @param  [type] $user_id [description]
     * @return [type]          [description]
     */
    public function myEval($user_id){
      return Cache::remember('zcjy_myEval_'.$user_id, Config::get('web.cachetime'), function() use($user_id){
                return ProductEval::where('user_id',$user_id)
                    ->with('attach')
                    ->with('product')
                    ->with('spec')
                    ->orderBy('created_at','desc')
                    ->get();
        });
    }

    /**
     * [判断这个人有没有评价过]
     * @param  [type] $item_id [description]
     * @param  [type] $user_id    [description]
     * @return [type]             [description]
     */
    public function varifyHadEvaled($item_id)
    {
        return Item::where('id',$item_id)->where('topiced',1)->first();
    }

    /**
     * [处理评价]
     * @param  [type] $item_id [description]
     * @return [type]          [description]
     */
    public function dealItemTopiced($item_id)
    {
        return Item::where('id',$item_id)->update(['topiced'=>1]);
    }

    /**
     * [为评价添加附加类型]
     * @param  [type] $eval  [description]
     * @param  [type] $input [description]
     * @return [type]        [description]
     */
    public function attachEval($eval,$input){
        if(array_key_exists('type',$input) && !empty($input['type'])){
            #先置空
            AttachEvals::where('eval_id',$eval->id)->delete();
            if(!is_array($input['type'])){
                $input['type'] = explode(',', $input['type']);
            }
            if(!is_array($input['url'])){
                $input['url'] = explode(',', $input['url']);
            }
            if(count($input['type'])){
                for ($i=0; $i < count($input['type']) ; $i++) { 
                    AttachEvals::create(['eval_id'=>$eval->id,'type'=>$input['type'][$i],'url'=>$input['url'][$i]]);
                }
            }
        }
    }

}
