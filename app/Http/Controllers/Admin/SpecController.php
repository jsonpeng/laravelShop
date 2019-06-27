<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateSpecRequest;
use App\Http\Requests\UpdateSpecRequest;
use App\Repositories\SpecRepository;
use App\Repositories\ProductTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Models\SpecItem;

class SpecController extends AppBaseController
{
    /** @var  SpecRepository */
    private $specRepository;
    private $productTypeRepository;

    public function __construct(SpecRepository $specRepo, ProductTypeRepository $productTypeRepo)
    {
        $this->specRepository = $specRepo;
        $this->productTypeRepository = $productTypeRepo;
    }

    /**
     * Display a listing of the Spec.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->specRepository->pushCriteria(new RequestCriteria($request));
        $specs = $this->specRepository->paginate($this->defaultPage());

        return view('admin.specs.index')
            ->with('specs', $specs);
    }

    /**
     * Show the form for creating a new Spec.
     *
     * @return Response
     */
    public function create()
    {
        $types = $this->productTypeRepository->TypeListArray();
        return view('admin.specs.create', compact('types'));
    }

    /**
     * Store a newly created Spec in storage.
     *
     * @param CreateSpecRequest $request
     *
     * @return Response
     */
    public function store(CreateSpecRequest $request)
    {
        $input = $request->all();

        $spec = $this->specRepository->create($input);
        $selections = preg_replace("/\n|\r\n/", "_", $input['selections']);
        $spec_items = explode('_', $selections);
        foreach ($spec_items as $key => $value) {
            SpecItem::create(['name' => $value, 'spec_id' => $spec->id]);
        }
        
        Flash::success('Spec saved successfully.');

        return redirect(route('specs.index'));
    }

    /**
     * Display the specified Spec.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $spec = $this->specRepository->findWithoutFail($id);

        if (empty($spec)) {
            Flash::error('Spec not found');

            return redirect(route('specs.index'));
        }

        return view('admin.specs.show')->with('spec', $spec);
    }

    /**
     * Show the form for editing the specified Spec.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $spec = $this->specRepository->findWithoutFail($id);

        if (empty($spec)) {
            Flash::error('Spec not found');

            return redirect(route('specs.index'));
        }
        $types = $this->productTypeRepository->TypeListArray();
        $selections = $spec->selections();

        return view('admin.specs.edit', compact('spec', 'types', 'selections'));
    }

    /**
     * Update the specified Spec in storage.
     *
     * @param  int              $id
     * @param UpdateSpecRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSpecRequest $request)
    {
        $spec = $this->specRepository->findWithoutFail($id);

        if (empty($spec)) {
            Flash::error('Spec not found');

            return redirect(route('specs.index'));
        }

        $input = $request->all();
        $spec = $this->specRepository->update($input, $id);
        $spec->items()->delete();

        $selections = preg_replace("/\n|\r\n/", "_", $input['selections']);
        $spec_items = explode('_', $selections);
        foreach ($spec_items as $key => $value) {
            SpecItem::create(['name' => $value, 'spec_id' => $spec->id]);
        }

        Flash::success('Spec updated successfully.');

        return redirect(route('specs.index'));
    }

    /**
     * Remove the specified Spec from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $spec = $this->specRepository->findWithoutFail($id);

        if (empty($spec)) {
            Flash::error('Spec not found');

            return redirect(route('specs.index'));
        }

        $this->specRepository->delete($id);

        Flash::success('Spec deleted successfully.');

        return redirect(route('specs.index'));
    }
}
