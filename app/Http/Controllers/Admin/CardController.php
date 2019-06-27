<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateCardRequest;
use App\Http\Requests\UpdateCardRequest;
use App\Repositories\CardRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Hash;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class CardController extends AppBaseController
{
    /** @var  CardRepository */
    private $cardRepository;

    public function __construct(CardRepository $cardRepo)
    {
        $this->cardRepository = $cardRepo;
    }

    /**
     * Display a listing of the Card.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->cardRepository->pushCriteria(new RequestCriteria($request));

        $cards = $this->cardRepository->model()::where('id','>',0);

        $input = app('commonRepo')->filterNullInput($request->all());

        if(isset($input['number']))
        {
            $cards = $cards->where('number','like','%'.$input['number'].'%');
        }

        if(isset($input['num']))
        {
            $cards = $cards->where('num','like','%'.$input['num'].'%');
        }

        if(isset($input['status']))
        {
            $cards = $cards->where('status',$input['status']);
        }

        $cards = paginateToShow($cards,'id');

        return view('admin.cards.index')
            ->with('cards', $cards)
            ->with('input',$input);
    }

    //批量导出
    public function exportAll(Request $request){
        $cards = $this->cardRepository->orderBy('id','asc')->get();
        if(count($cards) == 0){
            Flash::error('当前没有数据可以导出');
            return redirect(route('cards.index'));
        }
        $time = Carbon::now()->format('Y-m-d H:i:s');
        Excel::create($time.'卡记录列表', function($excel) use($cards) {
            //第一列sheet
            $excel->sheet('卡记录列表', function ($sheet) use ($cards) {
            $sheet->setWidth(array(
                'A' => 20,
                'B' => 15,
                'C' => 10,
                'D' => 10
            ));
            $sheet->appendRow(array('呗壳卡号', '密码', '面额', '使用状态'));
                    foreach ($cards as $key => $item) {
                        $sheet->appendRow(array(
                            $item->number,
                            $item->password,
                            $item->num,
                            $item->status ? '已使用' :'未使用' 
                        ));
                    }
         });
        })->download('xls');
    }

    //批量操作列表
    public function iframeList(Request $request){
        $cards = paginateToShow($this->cardRepository,'id');

        return view('admin.cards.list')
            ->with('cards', $cards);
    }

    //批量删除
    public function deleteMany(Request $request){
        $input = $request->all();

        if(!isset($input['card_arr'])){
            Flash::error('参数不完整!');
            return redirect(route('cards.index'));
        }

        if(!is_array($input['card_arr'])){
            $input['card_arr'] = explode(',',$input['card_arr']);
        }

        $this->cardRepository->model()::whereIn('id',$input['card_arr'])->delete();

        Flash::success('批量删除成功');
        return redirect(route('cards.index'));
    }

    /**
     * Show the form for creating a new Card.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.cards.create');
    }

    /**
     * Store a newly created Card in storage.
     *
     * @param CreateCardRequest $request
     *
     * @return Response
     */
    public function store(CreateCardRequest $request)
    {
        $input = $request->all();
 
        if(array_key_exists('card_num', $input)){
            $input['card_num']=$input['card_num']===1?0:$input['card_num'];
            #如果输入了数量 循环
            if(!empty($input['card_num'])){
               for($i=$input['card_num'];$i>0;$i--){
                     $input['number'] = app('commonRepo')->cardRepo()->newCode();
                     $input['password'] = app('commonRepo')->cardRepo()->randomString();
                     $this->cardRepository->create($input);
               }
            }#没有输入数量或者只输入了1 就创建对应的一个
            else{
                 $input['number'] = app('commonRepo')->cardRepo()->newCode();
                 $input['password'] = app('commonRepo')->cardRepo()->randomString();
                 $regCode = $this->cardRepository->create($input);
            }
        }
        $success_word = '添加'.getSettingValueByKeyCache('credits_alias').'成功.';

        if($input['card_num'] > 1){
             $success_word = '批量生成'.getSettingValueByKeyCache('credits_alias').'成功.';
        }

        Flash::success($success_word);

        return redirect(route('cards.index'));
    }

    /**
     * Display the specified Card.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $card = $this->cardRepository->findWithoutFail($id);

        if (empty($card)) {
            Flash::error('没有找到该记录');

            return redirect(route('cards.index'));
        }

        return view('admin.cards.show')->with('card', $card);
    }

    /**
     * Show the form for editing the specified Card.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $card = $this->cardRepository->findWithoutFail($id);

        if (empty($card)) {
            Flash::error('没有找到该记录');

            return redirect(route('cards.index'));
        }
        // $new_code = app('commonRepo')->cardRepo()->newCode();
        return view('admin.cards.edit')
        ->with('card', $card);
    }

    /**
     * Update the specified Card in storage.
     *
     * @param  int              $id
     * @param UpdateCardRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCardRequest $request)
    {
        $card = $this->cardRepository->findWithoutFail($id);

        if (empty($card)) {
            Flash::error('没有找到该记录');

            return redirect(route('cards.index'));
        }
        $input = $request->all();
   
        $card = $this->cardRepository->update($input, $id);

        Flash::success('更新成功.');

        return redirect(route('cards.index'));
    }

    /**
     * Remove the specified Card from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $card = $this->cardRepository->findWithoutFail($id);

        if (empty($card)) {
            Flash::error('没有找到该记录');

            return redirect(route('cards.index'));
        }

        $this->cardRepository->delete($id);

        Flash::success('删除成功');

        return redirect(route('cards.index'));
    }
}
