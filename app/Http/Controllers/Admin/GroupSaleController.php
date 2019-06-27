<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateGroupSaleRequest;
use App\Http\Requests\UpdateGroupSaleRequest;
use App\Repositories\GroupSaleRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SpecProductPriceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Product;
use App\Models\SpecProductPrice;

class GroupSaleController extends AppBaseController
{
    /** @var  GroupSaleRepository */
    private $groupSaleRepository;
    private $productRepository;
    private $specProductPriceRepository;
    public function __construct(GroupSaleRepository $groupSaleRepo,ProductRepository $productRepo,SpecProductPriceRepository $specProductPriceRepo)
    {
        $this->groupSaleRepository = $groupSaleRepo;
        $this->productRepository=$productRepo;
        $this->specProductPriceRepository=$specProductPriceRepo;
    }

    /**
     * Display a listing of the GroupSale.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->groupSaleRepository->pushCriteria(new RequestCriteria($request));
        $groupSales = $this->groupSaleRepository->all();

        return view('admin.group_sales.index')
            ->with('groupSales', $groupSales);
    }

    /**
     * Show the form for creating a new GroupSale.
     *
     * @return Response
     */
    public function create()
    {
        $product_spec=null;
        return view('admin.group_sales.create')
                ->with('product_spec',$product_spec);
    }

    /**
     * Store a newly created GroupSale in storage.
     *
     * @param CreateGroupSaleRequest $request
     *
     * @return Response
     */
    public function store(CreateGroupSaleRequest $request)
    {
        $input = $request->all();
        if(array_key_exists('product_spec',$input) && !empty($input['product_spec']) ) {
            $input=$this->progressGroupSale($input,$input['product_spec']);
        }
        $groupSale = $this->groupSaleRepository->create($input);
        $this->updateGroupSaleInfo($groupSale);
        Flash::success('Group Sale saved successfully.');

        return redirect(route('groupSales.index'));
    }

    /**
     * Display the specified GroupSale.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $groupSale = $this->groupSaleRepository->findWithoutFail($id);

        if (empty($groupSale)) {
            Flash::error('Group Sale not found');

            return redirect(route('groupSales.index'));
        }

        return view('admin.group_sales.show')->with('groupSale', $groupSale);
    }

    /**
     * Show the form for editing the specified GroupSale.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $groupSale = $this->groupSaleRepository->findWithoutFail($id);

        if (empty($groupSale)) {
            Flash::error('Group Sale not found');

            return redirect(route('groupSales.index'));
        }
        $product_spec=$groupSale->product_id.'_'.(is_null($groupSale->spec_id)?'0':$groupSale->spec_id);

        $product_id=$groupSale->product_id;
        $spec_id=$groupSale->spec_id;
        if($spec_id==0) {
            $product=$this->productRepository->findWithoutFail($product_id);
        }else{
            $product=$this->specProductPriceRepository->findWithoutFail($spec_id);
        }
        return view('admin.group_sales.edit')
                ->with('groupSale', $groupSale)
                ->with('product_spec',$product_spec)
                ->with('product',$product)
                ->with('spec_id',$spec_id);
    }

    /**
     * Update the specified GroupSale in storage.
     *
     * @param  int              $id
     * @param UpdateGroupSaleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGroupSaleRequest $request)
    {
        $groupSale = $this->groupSaleRepository->findWithoutFail($id);

        if (empty($groupSale)) {
            Flash::error('Group Sale not found');

            return redirect(route('groupSales.index'));
        }
        $input =$request->all();

        if(array_key_exists('product_spec',$input) && !empty($input['product_spec'])) {
            $input=$this->progressGroupSale($input,$input['product_spec']);
        }

        $groupSale = $this->groupSaleRepository->update($input, $id);
        $this->updateGroupSaleInfo($groupSale);
        Flash::success('Group Sale updated successfully.');

        return redirect(route('groupSales.index'));
    }

    /**
     * Remove the specified GroupSale from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $groupSale = $this->groupSaleRepository->findWithoutFail($id);

        if (empty($groupSale)) {
            Flash::error('Group Sale not found');

            return redirect(route('groupSales.index'));
        }

        $this->groupSaleRepository->delete($id);
        if($groupSale->spec_id==0) {
            $this->productRepository->resetPrompByPromId($id);
        }else{
            $this->specProductPriceRepository->resetPrompByPromId($id);
            $this->productRepository->resetPrompByPromId($id);
        }
        Flash::success('Group Sale deleted successfully.');

        return redirect(route('groupSales.index'));
    }

    private function progressGroupSale($inputs,$product_spec){
        $product_spec_arr=explode('_',$product_spec);
        if($product_spec_arr[1]=="0") {
            $inputs['product_id']=$product_spec_arr[0];
            $inputs['spec_id']=0;
        }else{
            $inputs['product_id']=$product_spec_arr[0];
            $inputs['spec_id']=$product_spec_arr[1];
        }
        return $inputs;
    }

    private function updateGroupSaleInfo($groupSale){
        //等于0只有商品没有规格信息
        if($groupSale->spec_id==0){
            $this->productRepository->updateProductPrompType($groupSale->product_id,$groupSale->id,2);
        }else{
            $this->specProductPriceRepository->updateSpecPrompType($groupSale->spec_id,$groupSale->id,2);
            $this->productRepository->updateProductPrompType($groupSale->product_id,$groupSale->id,2);
        }
    }

}
