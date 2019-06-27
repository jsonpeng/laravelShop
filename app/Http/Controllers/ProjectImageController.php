<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectImageRequest;
use App\Http\Requests\UpdateProjectImageRequest;
use App\Repositories\ProjectImageRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProjectImageController extends AppBaseController
{
    /** @var  ProjectImageRepository */
    private $projectImageRepository;

    public function __construct(ProjectImageRepository $projectImageRepo)
    {
        $this->projectImageRepository = $projectImageRepo;
    }

    /**
     * Display a listing of the ProjectImage.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->projectImageRepository->pushCriteria(new RequestCriteria($request));
        $projectImages = $this->projectImageRepository->all();

        return view('project_images.index')
            ->with('projectImages', $projectImages);
    }

    /**
     * Show the form for creating a new ProjectImage.
     *
     * @return Response
     */
    public function create()
    {
        return view('project_images.create');
    }

    /**
     * Store a newly created ProjectImage in storage.
     *
     * @param CreateProjectImageRequest $request
     *
     * @return Response
     */
    public function store(CreateProjectImageRequest $request)
    {
        $input = $request->all();

        $projectImage = $this->projectImageRepository->create($input);

        Flash::success('Project Image saved successfully.');

        return redirect(route('projectImages.index'));
    }

    /**
     * Display the specified ProjectImage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $projectImage = $this->projectImageRepository->findWithoutFail($id);

        if (empty($projectImage)) {
            Flash::error('Project Image not found');

            return redirect(route('projectImages.index'));
        }

        return view('project_images.show')->with('projectImage', $projectImage);
    }

    /**
     * Show the form for editing the specified ProjectImage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $projectImage = $this->projectImageRepository->findWithoutFail($id);

        if (empty($projectImage)) {
            Flash::error('Project Image not found');

            return redirect(route('projectImages.index'));
        }

        return view('project_images.edit')->with('projectImage', $projectImage);
    }

    /**
     * Update the specified ProjectImage in storage.
     *
     * @param  int              $id
     * @param UpdateProjectImageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProjectImageRequest $request)
    {
        $projectImage = $this->projectImageRepository->findWithoutFail($id);

        if (empty($projectImage)) {
            Flash::error('Project Image not found');

            return redirect(route('projectImages.index'));
        }

        $projectImage = $this->projectImageRepository->update($request->all(), $id);

        Flash::success('Project Image updated successfully.');

        return redirect(route('projectImages.index'));
    }

    /**
     * Remove the specified ProjectImage from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $projectImage = $this->projectImageRepository->findWithoutFail($id);

        if (empty($projectImage)) {
            Flash::error('Project Image not found');

            return redirect(route('projectImages.index'));
        }

        $this->projectImageRepository->delete($id);

        Flash::success('Project Image deleted successfully.');

        return redirect(route('projectImages.index'));
    }
}
