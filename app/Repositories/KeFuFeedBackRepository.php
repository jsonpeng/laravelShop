<?php

namespace App\Repositories;

use App\Models\KeFuFeedBack;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class KeFuFeedBackRepository
 * @package App\Repositories
 * @version August 22, 2018, 5:22 pm CST
 *
 * @method KeFuFeedBack findWithoutFail($id, $columns = ['*'])
 * @method KeFuFeedBack find($id, $columns = ['*'])
 * @method KeFuFeedBack first($columns = ['*'])
*/
class KeFuFeedBackRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'content',
        'tel'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return KeFuFeedBack::class;
    }
}
