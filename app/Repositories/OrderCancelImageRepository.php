<?php

namespace App\Repositories;

use App\Models\OrderCancelImage;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class OrderCancelImageRepository
 * @package App\Repositories
 * @version February 7, 2018, 4:17 pm CST
 *
 * @method OrderCancelImage findWithoutFail($id, $columns = ['*'])
 * @method OrderCancelImage find($id, $columns = ['*'])
 * @method OrderCancelImage first($columns = ['*'])
*/
class OrderCancelImageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'url',
        'order_cancel_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return OrderCancelImage::class;
    }
}
