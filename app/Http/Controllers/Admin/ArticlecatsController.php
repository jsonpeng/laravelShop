<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateArticlecatsRequest;
use App\Http\Requests\UpdateArticlecatsRequest;
use App\Repositories\ArticlecatsRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\CustomPostTypeRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Overtrue\Pinyin\Pinyin;

class ArticlecatsController extends AppBaseController
{
    /** @var  ArticlecatsRepository */
    private $categoryRepository;
    private $customPostTypeRepository;
    public function __construct(ArticlecatsRepository $categoryRepo,CustomPostTypeRepository $customPostTypeRepo)
    {
        $this->categoryRepository = $categoryRepo;
        $this->customPostTypeRepository=$customPostTypeRepo;
    }

    /**
     * Display a listing of the Articlecats.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $categories = $this->categoryRepository->getCascadeCategories();
        $baseurl = $request->root();
        
        return view('admin.articlecats.index')
            ->with('categories', $categories)
            ->with('baseurl', $baseurl);
    }

    /**
     * Show the form for creating a new Articlecats.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.articlecats.create')->with('categories', $this->categoryRepository->getRootCatArray());
    }

    /**
     * Store a newly created Articlecats in storage.
     *
     * @param CreateArticlecatsRequest $request
     *
     * @return Response
     */
    public function store(CreateArticlecatsRequest $request)
    {
        $input = $request->all();

        //如果用户没有输入别名，则自动生成
        if (!array_key_exists('slug', $input) || $input['slug'] == '') {
            $pinyin = new Pinyin();
            $input['slug'] = $pinyin->permalink($input['name']);
        }

        //清除空字符串
        $input = array_filter( $input, function($v, $k) {
            return $v != '';
        }, ARRAY_FILTER_USE_BOTH );

        $category = $this->categoryRepository->create($input);

        Flash::success('保存成功');

        return redirect(route('articlecats.index'));
    }

    /**
     * Display the specified Articlecats.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $category = $this->categoryRepository->findWithoutFail($id);

        if (empty($category)) {
            Flash::error('信息不存在');

            return redirect(route('articlecats.index'));
        }

        return view('admin.articlecats.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified Articlecats.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->findWithoutFail($id);

        if (empty($category)) {
            Flash::error('信息不存在');

            return redirect(route('articlecats.index'));
        }

        return view('admin.articlecats.edit')->with('category', $category)->with('categories', $this->categoryRepository->getRootCatArray($category->id));
    }

    /**
     * Update the specified Articlecats in storage.
     *
     * @param  int              $id
     * @param UpdateArticlecatsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateArticlecatsRequest $request)
    {
        $category = $this->categoryRepository->findWithoutFail($id);

        if (empty($category)) {
            Flash::error('信息不存在');

            return redirect(route('articlecats.index'));
        }

        $input = $request->all();

        //清除空字符串
        $input = array_filter( $input, function($v, $k) {
            return $v != '';
        }, ARRAY_FILTER_USE_BOTH );

        $category = $this->categoryRepository->update($input, $id);

        Flash::success('更新成功');

        return redirect(route('articlecats.index'));
    }

    /**
     * Remove the specified Articlecats from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->findWithoutFail($id);

        if (empty($category)) {
            Flash::error('信息不存在');

            return redirect(route('articlecats.index'));
        }

        $this->categoryRepository->delete($id);

        Flash::success('删除成功');

        return redirect(route('articlecats.index'));
    }

    /*
*获取分类的根分类
*/
    private function getCatRoot($slugOrId){
        $category = '';
        if (is_numeric($slugOrId)) {
            $category = $this->categoryRepository->getCacheCategory($slugOrId);
        } else {
            $category = $this->categoryRepository->getCacheCategoryBySlug($slugOrId);
        }
        //分类信息不存在
        if (empty($category)) {
            return null;
        }else{
            if ($category->parent_id == 0) {
                return $category;
            } else {
                return $this->getCatRoot($category->parent_id);
            }
        }
    }

    //根据分类id返回是否设定自定义字段附加对应的分类别名
    public function getCatRootSlug($cat_id){
        $category = $this->categoryRepository->getCacheCategory($cat_id);
        if (empty($category)) {
            return ['status'=>false,'msg'=>null];
        }else{
            if ($category->parent_id == 0) {
                $cat_custom=$this->customPostTypeRepository->getNameBySlug($category->slug);
                if(!empty($cat_custom)){
                    return ['status'=>true,'msg'=>$category->slug];
                }else{
                    return ['status'=>false,'msg'=>null];
                }
            } else {
                $cat_root= $this->getCatRoot($category->parent_id);
                $cat_custom=$this->customPostTypeRepository->getNameBySlug($cat_root->slug);
                if(!empty($cat_custom)){
                    return ['status'=>true,'msg'=>$cat_root->slug];
                }else{
                    return ['status'=>false,'msg'=>null];
                }
            }
        }
    }

}
