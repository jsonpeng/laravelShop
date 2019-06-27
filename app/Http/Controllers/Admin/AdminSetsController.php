<?php

namespace App\Http\Controllers\Admin;

// use App\Http\Requests\CreateadminRequest;
// use App\Http\Requests\UpdateadminRequest;
use App\Repositories\adminRepository;
use App\Repositories\ManagerRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Repositories\RoleRepository;
use Hash;

class AdminSetsController extends AppBaseController
{
    /** @var  adminRepository */
    private $managerRepository;
    private $roleRepository;

    public function __construct(ManagerRepository $managerRepo,RoleRepository $roleRepo)
    {
        $this->managerRepository = $managerRepo;
        $this->roleRepository=$roleRepo;
    }

    /**
     * Display a listing of the admin.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->managerRepository->pushCriteria(new RequestCriteria($request));
        $managers = $this->managerRepository->allManager();

        return view('admin.managers.index')
            ->with('managers', $managers);
    }

    /**
     * Show the form for creating a new admin.
     *
     * @return Response
     */
    public function create()
    {
        // dd(auth('admin')->user()->shop()->first());
        $roles = $this->roleRepository->all();
        return view('admin.managers.create')
             ->with('shops',app('commonRepo')->storeRepo()->all())
            ->with('selectedShop',[])
            ->with('roles',$roles);
    }

    /**
     * Store a newly created admin in storage.
     *
     * @param CreateadminRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $admin = $this->managerRepository->create($input);

        $this->attachActionShop($admin,$input);

        Flash::success('保存成功.');

        return redirect(route('managers.index'));
    }


    private function attachActionShop($admin,$input)
    {
        if(funcOpen('FUNC_MANY_SHOP')){
            if(array_key_exists('shop_id',$input)){
                $admin->shop()->sync($input['shop_id']);
            }
            else{
                 $admin->shop()->sync([]);
            }
        }
    }

    /**
     * Display the specified admin.
     *
     * @param  int $id
     *
     * @return Response


    /**
     * Show the form for editing the specified admin.
     *
     * @param  int $id
     *
     * @return Response
     */
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

        $shop = $manager->shop()->first();

        $selectedShop = $shop ? [$shop->id] : [];

        return view('admin.managers.edit')
            ->with('manager', $manager)
            ->with('roles', $roles)
            ->with('selectedRoles', $selectedRoles)
            ->with('shops',app('commonRepo')->storeRepo()->all())
            ->with('selectedShop',$selectedShop);

    }

    /**
     * Update the specified admin in storage.
     *
     * @param  int              $id
     * @param UpdateadminRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $input=$request->all();
        $manager = $this->managerRepository->findWithoutFail($id);

        if (empty($manager)) {
            Flash::error('管理员信息不存在');

            return redirect(route('managers.index'));
        }
        $input['password'] = Hash::make($input['password']);

        if (array_key_exists('roles', $input)) {
            $manager->roles()->sync($input['roles']);
        }else{
            $manager->roles()->sync([]);
        }

        $this->managerRepository->update($input, $id);

        $this->attachActionShop($manager,$input);

        Flash::success('保存成功.');

        return redirect(route('managers.index'));
    }

    /**
     * Remove the specified admin from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $manager = $this->managerRepository->findWithoutFail($id);

        if (empty($manager)) {
            Flash::error('没有找到该管理员');

            return redirect(route('managers.index'));
        }

        $this->managerRepository->delete($id);

        Flash::success('删除成功.');

        return redirect(route('managers.index'));
    }
}
