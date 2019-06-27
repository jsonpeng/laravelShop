<?php

namespace App\Repositories;

use App\Models\OrderRefundImage;
use InfyOm\Generator\Common\BaseRepository;

class OrderRefundImageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'url',
        'order_refunds_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return OrderRefundImage::class;
    }
}
