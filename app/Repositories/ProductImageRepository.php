<?php

namespace App\Repositories;

use App\Models\ProductImage;
use InfyOm\Generator\Common\BaseRepository;

class ProductImageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'url'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProductImage::class;
    }
}
