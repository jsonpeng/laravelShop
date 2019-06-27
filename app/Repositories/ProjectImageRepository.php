<?php

namespace App\Repositories;

use App\Models\ProjectImage;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectImageRepository
 * @package App\Repositories
 * @version August 13, 2018, 10:51 am CST
 *
 * @method ProjectImage findWithoutFail($id, $columns = ['*'])
 * @method ProjectImage find($id, $columns = ['*'])
 * @method ProjectImage first($columns = ['*'])
*/
class ProjectImageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'image',
        'project_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectImage::class;
    }
}
