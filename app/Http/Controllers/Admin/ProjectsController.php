<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateProjectsRequest;
use App\Http\Requests\UpdateProjectsRequest;
use App\Repositories\ProjectsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProjectsController extends AppBaseController
{
    /** @var  ProjectsRepository */
    private $projectsRepository;

    public function __construct(ProjectsRepository $projectsRepo)
    {
        $this->projectsRepository = $projectsRepo;
    }

    /**
     * Display a listing of the Projects.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->projectsRepository->pushCriteria(new RequestCriteria($request));
        $projects = descAndPaginateToShow($this->projectsRepository);

        return view('admin.projects.index')
            ->with('projects', $projects);
    }

    /**
     * Show the form for creating a new Projects.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.projects.create')
        ->with('images',[]);
    }

    /**
     * Store a newly created Projects in storage.
     *
     * @param CreateProjectsRequest $request
     *
     * @return Response
     */
    public function store(CreateProjectsRequest $request)
    {
        $input = $request->all();

        $projects = $this->projectsRepository->create($input);

        if(array_key_exists('project_images', $input)){
            if(!is_array($input['project_images'])){
                $input['project_images'] = explode(',', $input['project_images']);
            }
            app('commonRepo')->projectsRepo()->syncImages($projects->id,$input['project_images']);
        }

        Flash::success('项目添加成功.');

        return redirect(route('projects.index'));
    }

    /**
     * Display the specified Projects.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $projects = $this->projectsRepository->findWithoutFail($id);

        if (empty($projects)) {
            Flash::error('没有找到该项目');

            return redirect(route('projects.index'));
        }

        return view('admin.projects.show')->with('projects', $projects);
    }

    /**
     * Show the form for editing the specified Projects.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $projects = $this->projectsRepository->findWithoutFail($id);

        if (empty($projects)) {
            Flash::error('没有找到该项目');

            return redirect(route('projects.index'));
        }
        
        $images = $projects->images()->get();
        return view('admin.projects.edit')
        ->with('projects', $projects)
        ->with('images',$images);
    }

    /**
     * Update the specified Projects in storage.
     *
     * @param  int              $id
     * @param UpdateProjectsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProjectsRequest $request)
    {
        $projects = $this->projectsRepository->findWithoutFail($id);

        if (empty($projects)) {
            Flash::error('没有找到该项目');

            return redirect(route('projects.index'));
        }
        $input = $request->all();
        $projects = $this->projectsRepository->update($input, $id);
          
        if(array_key_exists('project_images', $input)){
            if(!is_array($input['project_images'])){
                $input['project_images'] = explode(',', $input['project_images']);
            }
            app('commonRepo')->projectsRepo()->syncImages($projects->id,$input['project_images'],'update');
        }


        Flash::success('项目更新成功.');

        return redirect(route('projects.index'));
    }

    /**
     * Remove the specified Projects from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $projects = $this->projectsRepository->findWithoutFail($id);

        if (empty($projects)) {
            Flash::error('没有找到该项目');

            return redirect(route('projects.index'));
        }

        $this->projectsRepository->delete($id);

        app('commonRepo')->projectsRepo()->deleteImages($id);

        Flash::success('项目删除成功.');

        return redirect(route('projects.index'));
    }
}
