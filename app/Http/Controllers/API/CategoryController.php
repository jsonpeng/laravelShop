<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    //一二级分类，用户分类展示
    public function topTwoLevelCategories()
    {
        $categories = $this->categoryRepository->getTopTwoLevelCats();
    	return ['status_code' => 0, 'data' => $categories];
    }

    /**
     * 获取推荐的分类
     * @return [type] [description]
     */
    public function catsOfRecommend()
    {
        $categories = $this->categoryRepository->getRecommendCategoriesCached();
        return ['status_code' => 0, 'data' => $categories];
    }

    /**
     * 获取子分类信息
     * @param  Request $request [description]
     * @param  [type]  $cat_id  [description]
     * @return [type]           [description]
     */
    public function childrenOfCat(Request $request, $cat_id)
    {
        $categories = $this->categoryRepository->getChildCategories($cat_id);
        return ['status_code' => 0, 'data' => $categories];
    }

    /**
     * 一级分类信息
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function allCatsRoot(Request $request){
        $categories=$this->categoryRepository->getRootCategoriesCached();
        return ['status_code' => 0, 'data' => $categories];
    }

    

}
