<?php

namespace App\Repositories;

use App\Models\Brand;
use InfyOm\Generator\Common\BaseRepository;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class BrandRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'intro',
        'sort',
        'image',
        'parent_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Brand::class;
    }

    public function allCached()
    {
        return Cache::remember('all_brands', Config::get('web.cachetime'), function(){
            return  Brand::orderBy('sort', 'asc')->get();
        });
    }

    public function getBrandArray(){
        $brandArray = array(null => '无品牌');
        $brands = Brand::select('id', 'name')->get()->toArray();
        while (list($key, $val) = each($brands)) {
            $brandArray[$val['id']] = $val['name'];
        }
        return $brandArray;
    }

    public function getProductsOfBrandCached($brand_id, $skip = 0,$take = 18)
    {
        return Cache::remember('products_of_brand_'.$brand_id.'_'.$skip.'_'.$take, Config::get('web.cachetime'), function() use($brand_id,$skip,$take) {
            return \App\Models\Product::where('brand_id', $brand_id)
            ->where('shelf',1)
            ->orderBy('sort', 'asc')
            ->skip($skip)
            ->take($take)
            ->get();
        });
    }

    public function pagelist($page){
        if($page==0 || empty($page)){
            $page=1;
        }
        return Brand::paginate($page);
    }
}
