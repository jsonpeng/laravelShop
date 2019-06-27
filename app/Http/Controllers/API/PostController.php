<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;


use App\Http\Controllers\Controller;

use App\Repositories\ProductRepository;
use App\Repositories\ArticlecatsRepository;
use App\Repositories\SingelPageRepository;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;


class PostController extends Controller
{

    
    private $productRepository;
    private $articlecatsRepository;
    private $singelPageRepository;

    public function __construct(
        ProductRepository $productRepo, 
        ArticlecatsRepository $articlecatsRepo,
        SingelPageRepository $singelPageRepo
    )
    {
        $this->articlecatsRepository=$articlecatsRepo;
        $this->productRepository = $productRepo;
        $this->singelPageRepository=$singelPageRepo;
    }

    /**
     * 话题分类列表
     */
    public function getCatsFound(){

        $cats=$this->articlecatsRepository->getCacheCategoryAll();
        return ['status_code' => 0, 'data' => $cats];

    }


    /**
     * 单页列表
     */
    public function getSingePageList(){

        $singlepages=$this->singelPageRepository->descToShow();
        return ['status_code' => 0, 'data' => $singlepages];

    }

    /**
     * 单页内容
     */
    public function getSingePageBySlug($slug){

        $singlepage=$this->singelPageRepository->getCacheSinglePageBySlug($slug);
        return ['status_code' => 0, 'data' => $singlepage];

    }


    /**
     * 话题列表
     * @param  [int]  $type [description]
     * @param  [int]  $is_hot   [description]
     * @return [type]            [description]
     * @return [type] [description]
     */
    public function getPostsFound(Request $request,$type=null)
    {
        $skip = 0;
        $take = 18;

        # $type = null;有分类就是分类id没有就是null
        
        #是否热门
        $is_hot =null;

        if ($request->has('skip')) {
            $skip = $request->input('skip');
        }

        if ($request->has('take')) {
            $take = $request->input('take');
        }

        if ($request->has('is_hot')) {
            $is_hot = $request->input('is_hot');
        }

        $posts=empty($type)?$this->articlecatsRepository->getAllCachePostsWithHot($is_hot,$skip,$take):$this->articlecatsRepository->getCachePostsOfCatIdWithHot($is_hot,$type,$skip,$take);
    
     
        return ['status_code' => 0, 'data' => $posts];
    }






    
}
