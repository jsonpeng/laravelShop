<?php

namespace App\Repositories;

use App\Models\Spec;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SpecRepository
 * @package App\Repositories
 * @version January 7, 2018, 4:47 am UTC
 *
 * @method Spec findWithoutFail($id, $columns = ['*'])
 * @method Spec find($id, $columns = ['*'])
 * @method Spec first($columns = ['*'])
*/
class SpecRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'sort',
        'type_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Spec::class;
    }
}
