<?php

namespace App\Repositories;

use App\Models\ProductType;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProductTypeRepository
 * @package App\Repositories
 * @version January 7, 2018, 4:16 am UTC
 *
 * @method ProductType findWithoutFail($id, $columns = ['*'])
 * @method ProductType find($id, $columns = ['*'])
 * @method ProductType first($columns = ['*'])
*/
class ProductTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProductType::class;
    }

    public function TypeListArray(){
        $typeArray = array();
        $types = ProductType::all()->toArray();
        while (list($key, $val) = each($types)) {
            $typeArray[$val['id']] = $val['name'];
        }
        return $typeArray;
    }

    public function pagelist($page){
        if($page==0 || empty($page)){
            $page=1;
        }
        return ProductType::paginate($page);
    }
}
