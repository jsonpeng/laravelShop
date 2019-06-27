<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateThemeRequest;
use App\Http\Requests\UpdateThemeRequest;
use App\Repositories\ThemeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Models\Category;
use App\Models\Theme;

class ThemeController extends AppBaseController
{
    /** @var  ThemeRepository */
    private $themeRepository;

    public function __construct(ThemeRepository $themeRepo)
    {
        $this->themeRepository = $themeRepo;
    }

    /**
     * Display a listing of the Theme.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        //$this->themeRepository->pushCriteria(new RequestCriteria($request));
        //$themes = $this->themeRepository->all();
        $themes = Theme::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.themes.index')
            ->with('themes', $themes);
    }

    /**
     * Show the form for creating a new Theme.
     *
     * @return Response
     */
    public function create()
    {
        //dd(Category::with('products_name')->get());
        $cats = Category::with('products_name')->get();
        return view('admin.themes.create')->with('cats', $cats);
    }

    /**
     * Store a newly created Theme in storage.
     *
     * @param CreateThemeRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        if (array_key_exists('intro', $input)) {
            $input['intro'] = str_replace("../../../", $request->getSchemeAndHttpHost().'/' ,$input['intro']);
        }

        $theme = $this->themeRepository->create($input);

        Flash::success('专题保存成功');

        if ( array_key_exists('categories', $input) ) {
            $theme->products()->sync($input['products']);
        }

        return redirect(route('themes.index'));
    }

    /**
     * Display the specified Theme.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $theme = $this->themeRepository->findWithoutFail($id);

        if (empty($theme)) {
            Flash::error('专题不存在');

            return redirect(route('themes.index'));
        }

        return view('admin.themes.show')->with('theme', $theme);
    }

    /**
     * Show the form for editing the specified Theme.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $theme = $this->themeRepository->findWithoutFail($id);

        if (empty($theme)) {
            Flash::error('专题不存在');

            return redirect(route('themes.index'));
        }

        $selectedProducts = [];
        $tmparray = $theme->products()->get()->toArray();
        while (list($key, $val) = each($tmparray)) {
            array_push($selectedProducts, $val['id']);
        }

        $cats = Category::with('products_name')->get();

        return view('admin.themes.edit')->with('theme', $theme)->with('cats', $cats)->with('selectedProducts', $selectedProducts);
    }

    /**
     * Update the specified Theme in storage.
     *
     * @param  int              $id
     * @param UpdateThemeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateThemeRequest $request)
    {
        $theme = $this->themeRepository->findWithoutFail($id);

        if (empty($theme)) {
            Flash::error('专题不存在');

            return redirect(route('themes.index'));
        }

        $intpus = $request->all();
        if (array_key_exists('intro', $intpus)) {
            $intpus['intro'] = str_replace("../../../", $request->getSchemeAndHttpHost().'/' ,$intpus['intro']);
        }
        $theme = $this->themeRepository->update($intpus, $id);

        Flash::success('专题更新成功');
        if ( array_key_exists('products', $intpus) ) {
            $theme->products()->sync($intpus['products']);
        }else{
            $theme->products()->sync([]);
        }

        return redirect(route('themes.index'));
    }

    /**
     * Remove the specified Theme from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $theme = $this->themeRepository->findWithoutFail($id);

        if (empty($theme)) {
            Flash::error('专题不存在');

            return redirect(route('themes.index'));
        }

        $theme->products()->sync([]);

        $this->themeRepository->delete($id);

        Flash::success('专题删除成功');

        return redirect(route('themes.index'));
    }
}
