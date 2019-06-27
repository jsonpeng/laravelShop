<?php

namespace App\Repositories;

use App\Models\AttachEvals;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AttachEvalsRepository
 * @package App\Repositories
 * @version August 17, 2018, 9:27 am CST
 *
 * @method AttachEvals findWithoutFail($id, $columns = ['*'])
 * @method AttachEvals find($id, $columns = ['*'])
 * @method AttachEvals first($columns = ['*'])
*/
class AttachEvalsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'eval_id',
        'type',
        'url'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return AttachEvals::class;
    }
}
