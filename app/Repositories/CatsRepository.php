<?php

namespace App\Repositories;

use App\Models\Cats;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CatsRepository
 * @package App\Repositories
 * @version August 15, 2018, 9:25 am CST
 *
 * @method Cats findWithoutFail($id, $columns = ['*'])
 * @method Cats find($id, $columns = ['*'])
 * @method Cats first($columns = ['*'])
*/
class CatsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'sort'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Cats::class;
    }
}
