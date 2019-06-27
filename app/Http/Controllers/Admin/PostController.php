<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Repositories\PostRepository;
use App\Repositories\ArticlecatsRepository;
use App\Repositories\PostItemsRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\CustomPostTypeRepository;
use App\Repositories\CustomPostTypeItemsRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use Overtrue\Pinyin\Pinyin;
use App\Models\Post;
use Auth;

class PostController extends AppBaseController
{
    /** @var  PostRepository */
    private $postRepository;
    private $categoryRepository;
    private $customPostTypeRepository;
    private $customPostTypeItemsRepository;
    private $postItemsRepository;
    public function __construct(PostRepository $postRepo,PostItemsRepository $postItemsRepo, ArticlecatsRepository $categoryRepo,CustomPostTypeRepository $customPostTypeRepo,CustomPostTypeItemsRepository $customPostTypeItemsRepo)
    {
        $this->postRepository = $postRepo;
        $this->postItemsRepository=$postItemsRepo;
        $this->categoryRepository = $categoryRepo;
        $this->customPostTypeRepository=$customPostTypeRepo;
        $this->customPostTypeItemsRepository=$customPostTypeItemsRepo;
    }


    public function getCustomType(){
        $customPostTypes = $this->customPostTypeRepository->all();
        return ['status'=>true,'msg'=>$customPostTypes];
    }

    /**
     * Display a listing of the Post.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        //$this->postRepository->pushCriteria(new RequestCriteria($request));
        //$posts = $this->postRepository->all();
        $input=$request->all();

        session(['articelListUrl' => $request->fullUrl()]);

        $input = array_filter( $input, function($v, $k) {
            return $v != '';
        }, ARRAY_FILTER_USE_BOTH );

        if (!array_key_exists('cat', $input) || (array_key_exists('cat', $input) && $input['cat'] == '全部')) {
            $posts = Post::orderBy('updated_at', 'desc');
        }else{
            $cat = $this->categoryRepository->getCacheCategory($input['cat']);
            $posts = $cat->posts()->orderBy('updated_at', 'desc');
        }

        if (array_key_exists('name', $input)) {
            $posts=  $posts->where('name', 'like', '%'.$input['name'].'%');
        }
        if (array_key_exists('status', $input) && $input['status'] != '全部') {
            $posts=  $posts->where('status', $input['status']);
        }

        $posts = $posts->paginate(5);

        $categories = $this->categoryRepository->getCascadeCategories();

        $baseurl = $request->root();

        return view('admin.posts.index')
            ->with('posts', $posts)
            ->with('categories', $categories)
            ->with('baseurl', $baseurl)->withInput($input);
    }

    /**
     * Show the form for creating a new Post.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $input=$request->all();
        $products=[];
        $specs=[];
        $categories = $this->categoryRepository->getCascadeCategories();
        return view('admin.posts.create')
            ->with('categories', $categories)
            ->with('images',[])
            ->with('products',$products)
            ->with('specs',$specs)
            ->withInput($input);
    }

    /**
     * Store a newly created Post in storage.
     *
     * @param CreatePostRequest $request
     *
     * @return Response
     */
    public function store(CreatePostRequest $request)
    {
        $input = $request->all();
        $input['user_id']=Auth::guard('admin')->user()->id;

        //清除空字符串
        $input = array_filter( $input, function($v, $k) {
            return $v != '';
        }, ARRAY_FILTER_USE_BOTH );

        if (array_key_exists('content', $input)) {
            $input['content'] = str_replace("../../../", $request->getSchemeAndHttpHost().'/' ,$input['content']);
            $input['content'] = str_replace("../../", $request->getSchemeAndHttpHost().'/' ,$input['content']);
        }

        $post = $this->postRepository->create($input);

        if ( !array_key_exists('status', $input) ) {
            $input['status'] = 0;
        }

        if ( !array_key_exists('is_hot', $input) ) {
            $input['is_hot'] = 0;
        }
        #关联分类
        if ( array_key_exists('categories', $input) ) {
            $post->cats()->sync($input['categories']);
        }

        #添加附加图片
        if(array_key_exists('post_images',$input)){
          $this->postRepository->syncImages($input['post_images'],$post->id);
        }

        #关联商品
        if(array_key_exists('product_spec',$input) && !empty($input['product_spec'])){
           $this->updateWithProductInfo($input['product_spec'],$post);
        }

        Flash::success('保存成功');

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified Post.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $post = $this->postRepository->findWithoutFail($id);

        if (empty($post)) {
            Flash::error('信息不存在');

            return redirect(route('posts.index'));
        }

        return view('admin.posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified Post.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit(Request $request,$id)
    {
        $input=$request->all();
        $post = $this->postRepository->findWithoutFail($id);
        if (empty($post)) {
            Flash::error('信息不存在');

            return redirect(route('posts.index'));
        }

        //dd($post->user()->first());
        $selectedCategories = [];
        $tmparray = $post->cats()->get()->toArray();
        while (list($key, $val) = each($tmparray)) {
            array_push($selectedCategories, $val['id']);
        }

        $categories = $this->categoryRepository->getCascadeCategories();

        #文章的图片
        $images=$this->postRepository->getImages($post);

        //dd($images);
        $products=$this->postRepository->getProductListByPostId($id);

        $specs=$this->postRepository->getSpecsListByPostId($id);

        return view('admin.posts.edit')
            ->with('post', $post)
            ->with('selectedCategories', $selectedCategories)
            ->with('categories', $categories)
            ->with('images',$images)
            ->with('products',$products)
            ->with('specs',$specs)
            ->withInput($input);
    }

    /**
     * Update the specified Post in storage.
     *
     * @param  int              $id
     * @param UpdatePostRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostRequest $request)
    {
        $post = $this->postRepository->findWithoutFail($id);

        if (empty($post)) {
            Flash::error('信息不存在');

            return redirect(route('posts.index'));
        }

        $input = $request->all();

        if ( !array_key_exists('status', $input) ) {
            $input['status'] = 0;
        }

        if ( !array_key_exists('is_hot', $input) ) {
            $input['is_hot'] = 0;
        }

        if (array_key_exists('content', $input)) {
            $input['content'] = str_replace("../../../", $request->getSchemeAndHttpHost().'/' ,$input['content']);
            $input['content'] = str_replace("../../", $request->getSchemeAndHttpHost().'/' ,$input['content']);
        }

        $post = $this->postRepository->update($input, $id);

        #分类
        if (array_key_exists('categories', $input)) {
            $post->cats()->sync($input['categories']);
        }else{
            $post->cats()->sync([]);
        }

        #更新附加图片
        if(array_key_exists('post_images',$input)){
          $this->postRepository->syncImages($input['post_images'],$post->id,true);
        }else{
          $this->postRepository->clearImages($id);
        }

        #更新关联商品
        if(array_key_exists('product_spec',$input) && !empty($input['product_spec'])){
            //先清空
            $post->products()->sync([]);
            //然后更新信息
            $this->updateWithProductInfo($input['product_spec'],$post);
        }
        else{
            $post->products()->sync([]);
        }

        Flash::success('更新成功');

      
        return redirect(session('articelListUrl'));
    }

    /**
     * Remove the specified Post from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $post = $this->postRepository->findWithoutFail($id);

        if (empty($post)) {
            Flash::error('信息不存在');

            return redirect(route('posts.index'));
        }


        $this->postRepository->delete($id);

        #删除文章图片
        $this->postRepository->clearImages($id);

        #删除关联商品
        $post->products()->sync([]);
        
        Flash::success('删除成功.');

        return redirect(session('articelListUrl'));
      
    }



    //更新文章关联商品信息
    private function updateWithProductInfo($inputs,$post){
        $specIdArray =  $inputs;
        for ($i = count($specIdArray)-1; $i>=0; $i--) {
            $spec_product=$specIdArray[$i];
            $spec_product_arr=explode('_',$spec_product);
            if($spec_product_arr[1]=="0"){
                $post->products()->attach($spec_product_arr[0]);
            }else{
                $post->products()->attach($spec_product_arr[0],['spec_price_id'=>$spec_product_arr[1]]);
            }
        }
    }

}
