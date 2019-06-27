<?php

namespace App\Repositories;

use App\Models\UserLevel;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserLevelRepository
 * @package App\Repositories
 * @version January 6, 2018, 2:33 am UTC
 *
 * @method UserLevel findWithoutFail($id, $columns = ['*'])
 * @method UserLevel find($id, $columns = ['*'])
 * @method UserLevel first($columns = ['*'])
*/
class UserLevelRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'amount',
        'discount',
        'discribe'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserLevel::class;
    }
}
