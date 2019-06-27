<?php

namespace App\Repositories;

use App\Models\PostItems;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PostItemsRepository
 * @package App\Repositories
 * @version December 19, 2017, 9:52 am CST
 *
 * @method PostItems findWithoutFail($id, $columns = ['*'])
 * @method PostItems find($id, $columns = ['*'])
 * @method PostItems first($columns = ['*'])
*/
class PostItemsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'key',
        'name',
        'value',
        'post_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PostItems::class;
    }

    //通过文章id和关键字段更新内容
    public function updateByPostIdAndKey($post_id,$key,$attribute){
        return PostItems::where('post_id',$post_id)->where('key',$key)->update($attribute);
    }

    //通过文章id删除
    public function deleteByPostId($post_id){
        return PostItems::where('post_id',$post_id)->delete();
    }



}
