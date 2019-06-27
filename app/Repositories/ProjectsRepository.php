<?php

namespace App\Repositories;

use App\Models\Projects;
use App\Models\ProjectImage;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectsRepository
 * @package App\Repositories
 * @version August 13, 2018, 10:14 am CST
 *
 * @method Projects findWithoutFail($id, $columns = ['*'])
 * @method Projects find($id, $columns = ['*'])
 * @method Projects first($columns = ['*'])
*/
class ProjectsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'mobile',
        'weixin_qq',
        'address',
        'content',
        'jindu',
        'weidu'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Projects::class;
    }

    public function deleteImages($project_id){
        ProjectImage::where('project_id',$project_id)->delete();
    }

    public function syncImages($project_id,$images_arr,$action='create'){
        if($action == 'update'){
            $this->deleteImages($project_id);
        }
        if(count($images_arr)){
            foreach ($images_arr as $key => $val) {
                    ProjectImage::create(['image'=>$val,'project_id'=>$project_id]);
            }
        }
    }


}
