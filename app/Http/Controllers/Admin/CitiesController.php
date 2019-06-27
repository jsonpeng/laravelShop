<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateBankSetsRequest;
use App\Http\Requests\UpdateBankSetsRequest;
use App\Repositories\BankSetsRepository;
//use App\Repositories\ManagerRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
//use App\Repositories\RoleRepository;
use Hash;
use App\Models\Cities;

class CitiesController extends AppBaseController
{
    /** @var  BankSetsRepository */
   // private $managerRepository;
   // private $roleRepository;

    public function __construct()
    {
        //$this->managerRepository = $managerRepo;
       // $this->roleRepository=$roleRepo;
    }

    /**
     * Display a listing of the BankSets.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        //$this->managerRepository->pushCriteria(new RequestCriteria($request));
        $cities=Cities::where('level',1)->get();
        return view('admin.cities.index')
                ->with('cities', $cities);
    }

    public function show(Request $request)
    {
       // $this->managerRepository->pushCriteria(new RequestCriteria($request));
        $cities=Cities::where('level',1)->get();
        return view('admin.cities.index')
            ->with('cities', $cities);
    }

    public function CitiesAjaxSelect($id){
        $cities=Cities::where('pid',$id)->get();
        $ajax_select=null;
        if(!empty($cities)){
            foreach ($cities as $city){
                $ajax_select .="<option value=".$city->id.">".$city->name."</option>";
            }
            return ['code'=>0,'message'=>$ajax_select];
        }else{
            return ['code'=>1,'message'=>'无'];
        }
    }

    public function CitiesSelectFrame(){
        $cities_level1=Cities::where('level',1)->get();
        return view('admin.cities.select')->with('cities_level1',$cities_level1);

    }

    public function ChildList(Request $request,$pid){
        $cities=Cities::where('pid',$pid)->get();
        return view('admin.cities.childlist')
            ->with('pid',$pid)
            ->with('cities', $cities);
    }

    public function GetFreightTemByCid($cid){
        $freight_tem=getFreightInfoByCitiesId($cid);
        if(!empty($freight_tem)){
            return ['code'=>0,'message'=>$freight_tem];
        }else{
            return ['code'=>1,'message'=>'没有找到对应的运费模板信息'];
        }
    }

    public function GetFreightTemByCidFrame($cid){
        $cities=Cities::find($cid);
        $freight_tem=getFreightInfoByCitiesId($cid);
        return view('admin.cities.freight_tem')
                ->with('freight_tem',$freight_tem)
                ->with('cities',$cities);
    }
    /**
     * Show the form for creating a new BankSets.
     *
     * @return Response
     */
    public function create()
    {
        $pid=1;
        $level=1;
        return view('admin.cities.create')
                ->with('pid',$pid)
                ->with('level',$level);
    }

    public function ChildCreate($pid){
        $last_cities=Cities::find($pid);
        if(!empty($last_cities)) {
           $level =$last_cities->level+1;
         return view('admin.cities.create_child')
            ->with('last_cities', $last_cities->name)
            ->with('pid', $pid)
            ->with('level',$level);
        }
    }



    /**
     * Store a newly created BankSets in storage.
     *
     * @param CreateBankSetsRequest $request
     *
     * @return Response
     */
    public function store(CreateBankSetsRequest $request)
    {
        $input = $request->all();
        Cities::create($input);
        Flash::success('保存成功.');
        if($input['pid']==1) {
            return redirect(route('cities.index'));
        }else{
            return redirect(route('cities.child.index',[$input['pid']]));
        }
    }

    /**
     * Display the specified BankSets.
     *
     * @param  int $id
     *
     * @return Response


    /**
     * Show the form for editing the specified BankSets.
     *
     * @param  int $id
     *
     * @return Response

    public function edit($id)
    {
        $manager = $this->managerRepository->findWithoutFail($id);

        if (empty($manager)) {
            Flash::error('没有找到该管理员');

            return redirect(route('managers.index'));
        }
        $roles = $this->roleRepository->all();

        $selectedRoles = [];
        $tmparray = $manager->roles()->get()->toArray();
        while (list($key, $val) = each($tmparray)) {
            array_push($selectedRoles, $val['id']);
        }

        return view('admin.managers.edit')
            ->with('manager', $manager)
            ->with('roles', $roles)
            ->with('selectedRoles', $selectedRoles);

    } */

    /**
     * Update the specified BankSets in storage.
     *
     * @param  int              $id
     * @param UpdateBankSetsRequest $request
     *
     * @return Response
     */
//    public function update($id, UpdateBankSetsRequest $request)
//    {
//        $input=$request->all();
//        $manager = $this->managerRepository->findWithoutFail($id);
//
//        if (empty($manager)) {
//            Flash::error('Bank Sets not found');
//
//            return redirect(route('managers.index'));
//        }
//        $input['password'] = Hash::make($input['password']);
//        //return $input;
//        if (array_key_exists('roles', $input)) {
//            $manager->roles()->sync($input['roles']);
//        }else{
//            $manager->roles()->sync([]);
//        }
//        $manager = $this->managerRepository->update($input, $id);
//
//
//
//        Flash::success('保存成功.');
//
//        return redirect(route('managers.index'));
//    }

    /**
     * Remove the specified BankSets from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cities = Cities::find($id);

        if (empty($cities)) {
            Flash::error('没有该地区');

            return redirect(route('managers.index'));
        }

        $cities->delete($id);

        Flash::success('删除成功.');

        return redirect(route('cities.index'));
    }
}
