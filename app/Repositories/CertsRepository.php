<?php

namespace App\Repositories;

use App\Models\Certs;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CertsRepository
 * @package App\Repositories
 * @version August 15, 2018, 6:27 pm CST
 *
 * @method Certs findWithoutFail($id, $columns = ['*'])
 * @method Certs find($id, $columns = ['*'])
 * @method Certs first($columns = ['*'])
*/
class CertsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'id_card',
        'face_image',
        'back_image',
        'hand_image',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Certs::class;
    }
}
