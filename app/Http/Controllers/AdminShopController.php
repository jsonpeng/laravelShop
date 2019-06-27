<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdminShopRequest;
use App\Http\Requests\UpdateAdminShopRequest;
use App\Repositories\AdminShopRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AdminShopController extends AppBaseController
{
    /** @var  AdminShopRepository */
    private $adminShopRepository;

    public function __construct(AdminShopRepository $adminShopRepo)
    {
        $this->adminShopRepository = $adminShopRepo;
    }

    /**
     * Display a listing of the AdminShop.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->adminShopRepository->pushCriteria(new RequestCriteria($request));
        $adminShops = $this->adminShopRepository->all();

        return view('admin_shops.index')
            ->with('adminShops', $adminShops);
    }

    /**
     * Show the form for creating a new AdminShop.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin_shops.create');
    }

    /**
     * Store a newly created AdminShop in storage.
     *
     * @param CreateAdminShopRequest $request
     *
     * @return Response
     */
    public function store(CreateAdminShopRequest $request)
    {
        $input = $request->all();

        $adminShop = $this->adminShopRepository->create($input);

        Flash::success('Admin Shop saved successfully.');

        return redirect(route('adminShops.index'));
    }

    /**
     * Display the specified AdminShop.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $adminShop = $this->adminShopRepository->findWithoutFail($id);

        if (empty($adminShop)) {
            Flash::error('Admin Shop not found');

            return redirect(route('adminShops.index'));
        }

        return view('admin_shops.show')->with('adminShop', $adminShop);
    }

    /**
     * Show the form for editing the specified AdminShop.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $adminShop = $this->adminShopRepository->findWithoutFail($id);

        if (empty($adminShop)) {
            Flash::error('Admin Shop not found');

            return redirect(route('adminShops.index'));
        }

        return view('admin_shops.edit')->with('adminShop', $adminShop);
    }

    /**
     * Update the specified AdminShop in storage.
     *
     * @param  int              $id
     * @param UpdateAdminShopRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAdminShopRequest $request)
    {
        $adminShop = $this->adminShopRepository->findWithoutFail($id);

        if (empty($adminShop)) {
            Flash::error('Admin Shop not found');

            return redirect(route('adminShops.index'));
        }

        $adminShop = $this->adminShopRepository->update($request->all(), $id);

        Flash::success('Admin Shop updated successfully.');

        return redirect(route('adminShops.index'));
    }

    /**
     * Remove the specified AdminShop from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $adminShop = $this->adminShopRepository->findWithoutFail($id);

        if (empty($adminShop)) {
            Flash::error('Admin Shop not found');

            return redirect(route('adminShops.index'));
        }

        $this->adminShopRepository->delete($id);

        Flash::success('Admin Shop deleted successfully.');

        return redirect(route('adminShops.index'));
    }
}
