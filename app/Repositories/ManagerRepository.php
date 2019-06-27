<?php

namespace App\Repositories;

use App\Models\Admin;
use InfyOm\Generator\Common\BaseRepository;

class ManagerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'nickname',
        'type'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Admin::class;
    }

    public function allManager(){
        return Admin::whereNotIn('system_tag', ['1'])->get();
    }
}
