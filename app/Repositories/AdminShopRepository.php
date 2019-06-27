<?php

namespace App\Repositories;

use App\Models\AdminShop;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AdminShopRepository
 * @package App\Repositories
 * @version September 4, 2018, 4:11 pm CST
 *
 * @method AdminShop findWithoutFail($id, $columns = ['*'])
 * @method AdminShop find($id, $columns = ['*'])
 * @method AdminShop first($columns = ['*'])
*/
class AdminShopRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'admin_id',
        'shop_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return AdminShop::class;
    }
}
