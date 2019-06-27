<?php

namespace App\Repositories;

use App\Models\Store;
use InfyOm\Generator\Common\BaseRepository;
use App\Models\Cats;

use Cache;
use Config;

/**
 * Class StoreRepository
 * @package App\Repositories
 * @version August 11, 2018, 2:04 pm CST
 *
 * @method Store findWithoutFail($id, $columns = ['*'])
 * @method Store find($id, $columns = ['*'])
 * @method Store first($columns = ['*'])
*/
class StoreRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'image',
        'jindu',
        'weidu',
        'address'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Store::class;
    }

    public function stores($skip = 0, $take = 18)
    {
        return Cache::remember('stores_skip_'.$skip.'_take_'.$take, Config::get('web.cachetime'), function() use ($skip, $take) {
            try {
                return Store::orderBy('created_at', 'desc')->skip($skip)->take($take)->get();
            } catch (Exception $e) {
                return [];
            }
        });
    }

    public function storesWithProducts($skip = 0, $take = 18)
    {
        return Cache::remember('storesWithProducts_skip_'.$skip.'_take_'.$take, Config::get('web.cachetime'), function() use ($skip, $take) {
            try {
                $stores = Store::orderBy('sort', 'desc')->skip($skip)->take($take)->get();
                foreach ($stores as $key => $value) {
                    $value['products'] = $value->products()->where('shelf',1)->get();
                }
                return $stores;
            } catch (Exception $e) {
                return [];
            }
        });
    }

    /**
     * 店铺分类
     * @return [type] [description]
     */
    public function storesCats(){
        return Cache::remember('storesCats', Config::get('web.cachetime'), function(){
                try {
                $cats = Cats::orderBy('sort','desc')->get();
                return $cats;
            } catch (Exception $e) {
                return [];
            }
        });
    }

    /**
     * 店铺分类下的店铺 cat_id传null取所有分类下的
     * @param  [type]  $cat_id [description]
     * @param  integer $skip   [description]
     * @param  integer $take   [description]
     * @return [type]          [description]
     */
    public function storesWithCats($cat_id = null,$skip = 0, $take = 18){
        return Cache::remember('storesWithCats_catid_'.$cat_id.'_skip_'.$skip.'_take_'.$take, Config::get('web.cachetime'), function() use ($cat_id,$skip,$take){
                try {
               if($cat_id == null){
                    $cats = $this->storesCats();
                    $stores = [];
                    foreach ($cats as $key => $cat) {
                        $cat_stores = $cat->stores;
                        if(count($cat_stores)){
                            foreach ($cat_stores as $key => $val) {
                               $stores[] = $val;
                            }
                        }
                    }
               }
               else{
                $cat = Cats::find($cat_id);
                if(!empty($cat)){
                    $stores = $cat->stores;
                }
                else{
                    $stores = [];
                }
               }
               return $stores;
            } catch (Exception $e) {
                return [];
            }
        });
    }

}
