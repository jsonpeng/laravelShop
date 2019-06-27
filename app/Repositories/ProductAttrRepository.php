<?php

namespace App\Repositories;

use App\Models\ProductAttr;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProductAttrRepository
 * @package App\Repositories
 * @version January 7, 2018, 5:06 am UTC
 *
 * @method ProductAttr findWithoutFail($id, $columns = ['*'])
 * @method ProductAttr find($id, $columns = ['*'])
 * @method ProductAttr first($columns = ['*'])
*/
class ProductAttrRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'isIndex',
        'input_type',
        'values',
        'sort'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProductAttr::class;
    }
}
