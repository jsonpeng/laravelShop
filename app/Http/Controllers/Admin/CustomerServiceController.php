<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateCustomerServiceRequest;
use App\Http\Requests\UpdateCustomerServiceRequest;
use App\Repositories\CustomerServiceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Config;

class CustomerServiceController extends AppBaseController
{
    /** @var  CustomerServiceRepository */
    private $customerServiceRepository;

    public function __construct(CustomerServiceRepository $customerServiceRepo)
    {
        $this->customerServiceRepository = $customerServiceRepo;
    }

    /**
     * Display a listing of the CustomerService.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->customerServiceRepository->pushCriteria(new RequestCriteria($request));
        $customerServices = descAndPaginateToShow($this->customerServiceRepository);

        return view('admin.customer_services.index')
            ->with('customerServices', $customerServices);
    }

    /**
     * Show the form for creating a new CustomerService.
     *
     * @return Response
     */
    public function create()
    {
        $customerService=null;
        $platforms=Config::get('serviceplateform');
        $selectPlatforms=null;
        $jobs=Config::get('servicejob');
        $selectJobs=null;
        return view('admin.customer_services.create',compact('customerService','platforms','selectPlatforms','jobs','selectJobs'));
    }

    /**
     * Store a newly created CustomerService in storage.
     *
     * @param CreateCustomerServiceRequest $request
     *
     * @return Response
     */
    public function store(CreateCustomerServiceRequest $request)
    {
        $input = $request->all();

        $customerService = $this->customerServiceRepository->create($input);

        Flash::success('客服添加成功.');

        return redirect(route('customerServices.index'));
    }

    /**
     * Display the specified CustomerService.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $customerService = $this->customerServiceRepository->findWithoutFail($id);

        if (empty($customerService)) {
            Flash::error('客服不存在');

            return redirect(route('customerServices.index'));
        }


        return view('admin.customer_services.show')->with('customerService', $customerService);
    }

    /**
     * Show the form for editing the specified CustomerService.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $customerService = $this->customerServiceRepository->findWithoutFail($id);

        if (empty($customerService)) {
            Flash::error('客服不存在');

            return redirect(route('customerServices.index'));
        }
        $platforms=Config::get('serviceplateform');
        $selectPlatforms=$customerService->platform;
        $jobs=Config::get('servicejob');
        $selectJobs=$customerService->job;
        return view('admin.customer_services.edit',compact('customerService','platforms','selectPlatforms','jobs','selectJobs'));

    }

    /**
     * Update the specified CustomerService in storage.
     *
     * @param  int              $id
     * @param UpdateCustomerServiceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCustomerServiceRequest $request)
    {
        $customerService = $this->customerServiceRepository->findWithoutFail($id);

        if (empty($customerService)) {
            Flash::error('客服不存在');

            return redirect(route('customerServices.index'));
        }

        $customerService = $this->customerServiceRepository->update($request->all(), $id);

        Flash::success('更新成功');

        return redirect(route('customerServices.index'));
    }

    /**
     * Remove the specified CustomerService from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $customerService = $this->customerServiceRepository->findWithoutFail($id);

        if (empty($customerService)) {
            Flash::error('客服不存在');

            return redirect(route('customerServices.index'));
        }

        $this->customerServiceRepository->delete($id);

        Flash::success('删除成功');

        return redirect(route('customerServices.index'));
    }
}
