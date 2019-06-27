<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateManagerRequest;
use App\Http\Requests\UpdateManagerRequest;
use App\Repositories\ManagerRepository;
//use App\Repositories\RoleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Hash;


class ManagerController extends AppBaseController
{
    /** @var  managerRepository */
    private $managerRepository;

    //private $roleRepository;

    public function __construct(ManagerRepository $managerRepo)
    {
        $this->managerRepository = $managerRepo;

         //$this->roleRepository = $roleRepo;
    }

    /**
     * Display a listing of the Shop.
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
     * Show the form for creating a new Shop.
     *
     * @return Response
     */
    public function create()
    {
    	//$roles = $this->roleRepository->all();
        $shops = app('commonRepo')->storeRepo()->all();
        return view('admin.managers.create')
            ->with('shops',$shops)
            ->with('selectedShop',[]);
    }

    /**
     * Store a newly created Shop in storage.
     *
     * @param CreatemanagerRequest $request
     *
     * @return Response
     */
    public function store(CreatemanagerRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        if (empty($input['nickname'])) {
        	$input['nickname'] = $input['name'] ;
        }

        $manager = $this->managerRepository->create($input);

        Flash::success('管理员创建成功');

        return redirect(route('managers.index'));
    }

    /**
     * Display the specified Shop.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $manager = $this->managerRepository->findWithoutFail($id);

        if (empty($manager)) {
            Flash::error('管理员信息不存在');

            return redirect(route('managers.index'));
        }

        return view('admin.managers.show')->with('manager', $manager);
    }

    /**
     * Show the form for editing the specified Shop.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $manager = $this->managerRepository->findWithoutFail($id);
        /*
        $roles = $this->roleRepository->all();

        $selectedRoles = [];
        $tmparray = $manager->roles()->get()->toArray();
        while (list($key, $val) = each($tmparray)) {
            array_push($selectedRoles, $val['id']);
        }


        if (empty($manager)) {
            Flash::error('管理员信息不存在');

            return redirect(route('managers.index'));
        }

        return view('admin.managers.edit')
	        ->with('manager', $manager)
	        ->with('roles', $roles)
	        ->with('selectedRoles', $selectedRoles);
            */
    }

    /**
     * Update the specified Shop in storage.
     *
     * @param  int              $id
     * @param UpdatemanagerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemanagerRequest $request)
    {
        $manager = $this->managerRepository->findWithoutFail($id);

        if (empty($manager)) {
            Flash::error('管理员信息不存在');

            return redirect(route('managers.index'));
        }

        $input = $request->all();

        $manager = $this->managerRepository->update($input, $id);

        Flash::success('管理员信息更新成功.');

        //更新权限信息
        if (array_key_exists('roles', $input)) {
        	$manager->roles()->sync($input['roles']);
        }else{
        	$manager->roles()->sync([]);
        }

        return redirect(route('managers.index'));
    }

    /**
     * Remove the specified Shop from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $manager = $this->managerRepository->findWithoutFail($id);

        if (empty($manager)) {
            Flash::error('管理员信息不存在');

            return redirect(route('managers.index'));
        }

        $this->managerRepository->delete($id);

        Flash::success('管理员删除成功.');

        return redirect(route('managers.index'));
    }
}
