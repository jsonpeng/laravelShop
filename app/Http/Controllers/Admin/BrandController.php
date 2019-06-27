<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Repositories\BrandRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use \Overtrue\Pinyin\Pinyin;

class BrandController extends AppBaseController
{
    /** @var  BrandRepository */
    private $brandRepository;

    public function __construct(BrandRepository $brandRepo)
    {
        $this->brandRepository = $brandRepo;
    }

    /**
     * Display a listing of the Brand.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $brands = descAndPaginateToShow($this->brandRepository);

        return view('admin.brands.index')
            ->with('brands', $brands);
    }


    public function iframe(Request $request){
        $brands = descAndPaginateToShow($this->brandRepository);
        $brands_num = count($this->brandRepository->all());
        return view('admin.brands.iframe')
            ->with('brands', $brands)
            ->with('brands_num',$brands_num);
    }

    /**
     * Show the form for creating a new Brand.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created Brand in storage.
     *
     * @param CreateBrandRequest $request
     *
     * @return Response
     */
    public function store(CreateBrandRequest $request)
    {
        $input = $request->all();

        //$input['slug'] = Pinyin::trans($input['name']);
        //$input['shop_id'] = app('zcjy.current_shop')->choosedId();
        if (!array_key_exists('sort', $input) || empty($input['sort'])) {
            $input['sort'] = 50;
        }

        $brand = $this->brandRepository->create($input);

        Flash::success('保存成功');

        return redirect(route('brands.index'));
    }

    /**
     * Display the specified Brand.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $brand = $this->brandRepository->findWithoutFail($id);

        if (empty($brand)) {
            Flash::error('信息不存在');

            return redirect(route('brands.index'));
        }

        return view('admin.brands.show')->with('brand', $brand);
    }

    /**
     * Show the form for editing the specified Brand.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {

        $brand = $this->brandRepository->findWithoutFail($id);

        if (empty($brand)) {
            Flash::error('信息不存在');

            return redirect(route('brands.index'));
        }

        return view('admin.brands.edit')->with('brand', $brand)->with('brands', $this->brandRepository->getBrandArray($id));
    }

    /**
     * Update the specified Brand in storage.
     *
     * @param  int              $id
     * @param UpdateBrandRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBrandRequest $request)
    {
        $brand = $this->brandRepository->findWithoutFail($id);

        if (empty($brand)) {
            Flash::error('信息不存在');

            return redirect(route('brands.index'));
        }

        $brand = $this->brandRepository->update($request->all(), $id);

        Flash::success('更新成功');

        return redirect(route('brands.index'));
    }

    /**
     * Remove the specified Brand from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $brand = $this->brandRepository->findWithoutFail($id);

        if (empty($brand)) {
            Flash::error('信息不存在');

            return redirect(route('brands.index'));
        }

        $this->brandRepository->delete($id);

        Flash::success('删除成功');

        return redirect(route('brands.index'));
    }
}
