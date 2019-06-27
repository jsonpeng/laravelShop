<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateFreightTemRequest;
use App\Http\Requests\UpdateFreightTemRequest;
use App\Repositories\FreightTemRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;


class FreightTemController extends AppBaseController
{
    /** @var  FreightTemRepository */
    private $freightTemRepository;

    public function __construct(FreightTemRepository $freightTemRepo)
    {
        $this->freightTemRepository = $freightTemRepo;
    }

    /**
     * Display a listing of the FreightTem.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->freightTemRepository->pushCriteria(new RequestCriteria($request));
        $freightTems = $this->freightTemRepository->all();
        $items=$this->freightTemRepository->getFirstTem();
        if(!empty($items)){
            return redirect(route('freightTems.edit',$items->id));
        }else{
            return redirect(route('freightTems.create'));
        }

        return view('admin.freight_tems.index')
            ->with('freightTems', $freightTems);
    }

    /**
     * Show the form for creating a new FreightTem.
     *
     * @return Response
     */
    public function create()
    {
        $freightTem=null;
        return view('admin.freight_tems.create')->with('freightTem',$freightTem);
    }

    /**
     * Store a newly created FreightTem in storage.
     *
     * @param CreateFreightTemRequest $request
     *
     * @return Response
     */
    public function store(CreateFreightTemRequest $request)
    {
        $input = $request->all();
        if(!array_key_exists('area_list',$input) || empty($input['area_list'])) {
                return redirect(route('freightTems.create'))
                    ->withErrors('请添加配送区域')
                    ->withInput($input);
        }
        //return $input['area_ids_list'];
        $freightTem = $this->freightTemRepository->create($input);
        $this->attachMoreInfoToFreight($input,$freightTem);
        Flash::success('添加成功.');

        return redirect(route('freightTems.index'));
    }

    /**
     * Display the specified FreightTem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $freightTem = $this->freightTemRepository->findWithoutFail($id);

        if (empty($freightTem)) {
            Flash::error('信息不存在');

            return redirect(route('freightTems.index'));
        }

        return view('admin.freight_tems.show')->with('freightTem', $freightTem);
    }

    /**
     * Show the form for editing the specified FreightTem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $freightTem = $this->freightTemRepository->findWithoutFail($id);

        if (empty($freightTem)) {
            Flash::error('信息不存在');

            return redirect(route('freightTems.index'));
        }
        $items=$freightTem->cities()->orderBy('id','asc')->get();
        return view('admin.freight_tems.edit')
                ->with('freightTem', $freightTem)
                ->with('items',$items);
    }


    public function getSystemDefaultSet(){

    }

    /**
     * Update the specified FreightTem in storage.
     *
     * @param  int              $id
     * @param UpdateFreightTemRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFreightTemRequest $request)
    {
        $input=$request->all();
        $freightTem = $this->freightTemRepository->findWithoutFail($id);

        if (empty($freightTem)) {
            Flash::error('信息不存在');

            return redirect(route('freightTems.index'));
        }
        if(!array_key_exists('area_list',$input) || empty($input['area_list'])) {
            return redirect(route('freightTems.edit',[$id]))
                ->withErrors('请添加配送区域')
                ->withInput($input);
        }

        $freightTem = $this->freightTemRepository->update($request->all(), $id);
        $this->attachMoreInfoToFreight($input,$freightTem);
        Flash::success('更新成功.');

        return redirect(route('freightTems.index'));
    }

    /**
     * Remove the specified FreightTem from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $freightTem = $this->freightTemRepository->findWithoutFail($id);

        if (empty($freightTem)) {
            Flash::error('信息不存在');

            return redirect(route('freightTems.index'));
        }

        $this->freightTemRepository->delete($id);
        $freightTem->cities()->sync([]);
        Flash::success('Freight Tem deleted successfully.');

        return redirect(route('freightTems.index'));
    }

    private function attachMoreInfoToFreight($inputs,$freightTem){
        if(array_key_exists('area_ids_list',$inputs)){
            $freight_type=$inputs['count_type'];
            $area_arr=$inputs['area_ids_list'];
            $freightTem->cities()->sync([]);
            for($i=0;$i<count($area_arr);$i++){
                if(strpos($area_arr[$i],',')!==false){
                 $area_arr_more=explode(',',$area_arr[$i]);
                  //dd($area_arr_more);
                    for($m=0;$m<count($area_arr_more);$m++){
                        $freightTem->cities()->attach($area_arr_more[$m], ['freight_first_count' => $inputs['freight_first_count'][$i],'freight_type'=>$freight_type, 'the_freight' => $inputs['the_freight'][$i], 'freight_continue_count' => $inputs['freight_continue_count'][$i], 'freight_continue_price' => $inputs['freight_continue_price'][$i]]);
                    }
                }else {
                    $freightTem->cities()->attach($area_arr[$i], ['freight_first_count' => $inputs['freight_first_count'][$i],'freight_type'=>$freight_type, 'the_freight' => $inputs['the_freight'][$i], 'freight_continue_count' => $inputs['freight_continue_count'][$i], 'freight_continue_price' => $inputs['freight_continue_price'][$i]]);
                }
            }
        }
    }

}
