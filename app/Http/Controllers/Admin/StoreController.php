<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Repositories\StoreRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class StoreController extends AppBaseController
{
    /** @var  StoreRepository */
    private $storeRepository;

    public function __construct(StoreRepository $storeRepo)
    {
        $this->storeRepository = $storeRepo;
    }

    /**
     * Display a listing of the Store.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if(funcOpen('FUNC_MANY_SHOP')){
            $admin = auth('admin')->user();
            if(!$admin->system_tag){
                $shop = $admin->shop()->first();
                if($shop){
                    return redirect(route('stores.edit',$shop->id));
                }
            }
        }

        $this->storeRepository->pushCriteria(new RequestCriteria($request));
        $stores = descAndPaginateToShow($this->storeRepository);

        return view('admin.stores.index')
            ->with('stores', $stores);
    }

    /**
     * Show the form for creating a new Store.
     *
     * @return Response
     */
    public function create()
    {
        $cats = app('commonRepo')->catsRepo()->all();
        return view('admin.stores.create')
                ->with('store',null)
                ->with('cats',$cats)
                ->with('selectedCats',[]);
    }

    /**
     * Store a newly created Store in storage.
     *
     * @param CreateStoreRequest $request
     *
     * @return Response
     */
    public function store(CreateStoreRequest $request)
    {
        $input = $request->all();

        if(empty($input['jindu']) || empty($input['weidu'])){
               Flash::error('地址还未解析成功,请重新填写地址');
               return redirect(route('stores.create'))
                        ->withInput($input);
        }

        $store = $this->storeRepository->create($input);

        if(array_key_exists('stores_cats',$input)){
            $store->cats()->sync($input['stores_cats']);
        }

        Flash::success('店铺添加成功.');

        return redirect(route('stores.index'));
    }

    /**
     * Display the specified Store.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $store = $this->storeRepository->findWithoutFail($id);

        if (empty($store)) {
            Flash::error('没有找到该店铺');

            return redirect(route('stores.index'));
        }

        return view('admin.stores.show')->with('store', $store);
    }

    /**
     * Show the form for editing the specified Store.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $store = $this->storeRepository->findWithoutFail($id);

        if (empty($store)) {
            Flash::error('没有找到该店铺');

            return redirect(route('stores.index'));
        }
        $cats = app('commonRepo')->catsRepo()->all();
        $selectedCats_arr = $store->cats()->get();
        $selectedCats = [];
        foreach ($selectedCats_arr as $key => $val) {
            $selectedCats[] = $val->id;
        }
        return view('admin.stores.edit')
        ->with('store', $store)
        ->with('cats',$cats)
        ->with('selectedCats',$selectedCats);
    }

    /**
     * Update the specified Store in storage.
     *
     * @param  int              $id
     * @param UpdateStoreRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStoreRequest $request)
    {
        $store = $this->storeRepository->findWithoutFail($id);

        if (empty($store)) {
            Flash::error('没有找到该店铺');

            return redirect(route('stores.index'));
        }
        $input = $request->all();
        if(empty($input['jindu']) || empty($input['weidu'])){
               Flash::error('地址还未解析成功,请重新填写地址');
                return redirect(route('stores.edit',$id))
                        ->withInput($input);
        }

        $store = $this->storeRepository->update($input, $id);

        if(array_key_exists('stores_cats',$input)){
            $store->cats()->sync($input['stores_cats']);
        }

        Flash::success('店铺更新成功.');

        return redirect(route('stores.index'));
    }

    /**
     * Remove the specified Store from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $store = $this->storeRepository->findWithoutFail($id);

        if (empty($store)) {
            Flash::error('没有找到该店铺');

            return redirect(route('stores.index'));
        }

        $this->storeRepository->delete($id);

        Flash::success('店铺删除成功.');

        return redirect(route('stores.index'));
    }
}
