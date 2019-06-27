<?php

namespace App\Repositories;

use App\Models\SpecProductPrice;
use InfyOm\Generator\Common\BaseRepository;
use DB;


/**
 * Class SpecProductPriceRepository
 * @package App\Repositories
 * @version January 9, 2018, 11:05 am UTC
 *
 * @method SpecProductPrice findWithoutFail($id, $columns = ['*'])
 * @method SpecProductPrice find($id, $columns = ['*'])
 * @method SpecProductPrice first($columns = ['*'])
*/
class SpecProductPriceRepository extends BaseRepository
{
  /**
   * @var array
   */
  protected $fieldSearchable = [
      'key',
      'key_name',
      'price',
      'inventory',
      'qrcode',
      'sku',
      'image',
      'prom_id',
      'prom_type'
  ];

  /**
   * Configure the Model
   **/
  public function model()
  {
      return SpecProductPrice::class;
  }

  /*
   * 清空促销
  */
  public function resetPrompByPromId($id){
      return SpecProductPrice::where('prom_id',$id)->update(['prom_type'=>null,'prom_id'=>null]);
  }

  /*
    * 获取指定活动的带规格信息的商品
    */
  public function getPrompSpecsByPromId($id){
      return SpecProductPrice::where('prom_id',$id)->get();
  }

  public function resetPrivateByProductIdAndSpecIdAndPrompType($product_id,$spec_id,$prom_type){
      return SpecProductPrice::where('product_id',$product_id)->where('id','<>',$spec_id)->where('prom_type','<>',3)->where('prom_type','<>',$prom_type)->update(['prom_type'=>null,'prom_id'=>null]);
  }


  /*
   * 更新商品的促销方式
   * 0无1抢购2团购3商品促销4订单促销5拼团
   */
  public function updateSpecPrompType($spec_id,$prom_id,$prom_type){
      return SpecProductPrice::where('id',$spec_id)->update(['prom_id'=>$prom_id,'prom_type'=>$prom_type]);

  }

  public function productSpecWithSalePrice($product_id,$return_arr=false)
  {
      $spec_goods_prices = SpecProductPrice::where('product_id', $product_id)->get();
      foreach ($spec_goods_prices as $item) {
          $item['realPrice'] = $this->getSalesPrice($item);
      }
     //json处理
     $spec_goods_price =!$return_arr?json_encode($spec_goods_prices):$spec_goods_prices;
    return $spec_goods_price;
  }

  public function getSalesPrice($spec, $includeTeamSale = true)
  {
    if (empty($spec->prom_type) || empty($spec->prom_id)) {
      return $spec->price;
    }
    //秒杀
    if ($spec->prom_type == 1) {
      $promp = \App\Models\FlashSale::where('id', $spec->prom_id)->first();
      if (!empty($promp) && $promp->spec_id == $spec->id && $promp->status == '进行中') {
          return $promp->price;
      }else{
          return $spec->price;
      }
    }
    //商品优惠进行中
    if ($spec->prom_type == 3) {
      $promp = \App\Models\ProductPromp::where('id', $spec->prom_id)->first();
      if (empty($promp) || $promp->status != '进行中') {
        return $spec->price;
      } else {
        //打折
        if ($promp->type == 0) {
            return round($spec->price*$promp->value/100, 2);
        }
        //减价
        if ($promp->type == 1) {
            return abs($spec->price - $promp->value);
        }
        //固定价格
        if ($promp->type == 2) {
            return $promp->value;
        }
        return $spec->price;
      }
    }

    # 拼团
    if ($spec->prom_type == 5 && $includeTeamSale) {
        $promp = \App\Models\TeamSale::where('id', $spec->prom_id)->first();
        if (!empty($promp)) {
            return $promp->price;
        }else{
            return $spec->price;
        }
    }else{
        return $spec->price;
    }
  }

  public function getSalesPriceById($id){
    $spec = $this->findWithoutFail($id);
    if (empty($spec)) {
        return null;
    }
    return $this->getSalesPrice($spec);
  }

  /**
     * 获取商品规格
     * @param $product_id|商品id
     * @return array
     */
    public function get_spec($product_id)
    {
        $specProductPrices = SpecProductPrice::where("product_id", $product_id)->get();
        $keys_array = array();
        foreach($specProductPrices as $spec)
        {                
            array_push($keys_array, $spec->key);
        }    
        $keys = implode("_", $keys_array);

        $filter_spec = array();
        if ($keys) {
            $keys = explode('_', $keys);
            $filter_spec2 = DB::table('specs')
            ->join('spec_items', 'spec_items.spec_id', '=', 'specs.id')
            ->select('specs.name as name2', 'spec_items.*')
            ->whereIn('spec_items.id', $keys)
            ->get();
            foreach ($filter_spec2 as $key => $val) {
                $filter_spec[$val->name2][] = array(
                    'item_id' => $val->id,
                    'item' => $val->name,
                );
            }
        }
        return $filter_spec; 
    }
}
