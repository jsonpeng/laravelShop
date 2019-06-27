@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left" style="margin-right: 15px;">{{ getSettingValueByKeyCache('credits_alias') }}卡列表</h1>
        <a class="btn btn-primary export" href="javascript:;"><i class="glyphicon glyphicon-refresh"></i>全部导出</a>
        <a class="btn btn-danger delete" href="javascript:;"><i class="glyphicon glyphicon-trash"></i>批量删除</a>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('cards.create') !!}">添加</a>
        </h1>
    </section>

         {!! Form::open(['route' => 'cards.export','id'=>'export','method'=>'post']) !!}

                 
         {!! Form::close() !!}

        {!! Form::open(['route' => 'cards.deletemany','id'=>'delete','method'=>'post']) !!}
                 <input type="hidden" name="card_arr" value="" />
         {!! Form::close() !!}

      

    <div class="content">
        <div class="clearfix"></div>
           <div class="box box-primary">
                            <div class="box-body">
                                <form id="form_search">
                                    <div class="form-group col-md-2">
                                        <label>卡号</label>
                                        <input type="text" class="form-control" name="number" id="number" placeholder="" @if (array_key_exists('number', $input)) value="{{$input['number']}}"@endif >
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>面额</label>
                                        <input type="text" class="form-control" name="num" id="num" placeholder="" @if (array_key_exists('num', $input)) value="{{$input['num']}}"@endif >
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>使用状态</label>
                                        <select class="form-control" name="status">
                                            <option value="" @if (!array_key_exists('status', $input)) selected="selected" @endif>全部</option>
                                            <option value="1" @if (array_key_exists('status', $input) && $input['status'] == '1') selected="selected" @endif>已使用</option>
                                            <option value="0" @if (array_key_exists('status', $input) && $input['status'] == '0') selected="selected" @endif>未使用</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-1">
                                        <label>操作</label>
                                        <button type="submit" class="btn btn-primary pull-right form-control" onclick="search()">查询</button>
                                    </div>
                                </form>
                            </div>
                        </div>
        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('admin.cards.table')
            </div>
        </div>
        <div class="text-center">
            {!! $cards->appends('')->links() !!}
        </div>
    </div>
@endsection


@section('scripts')
<script type="text/javascript">
    $(function(){
        //点击导出
       $('.export').click(function(){
            $('#export').submit();
        });
       //打开删除iframe
       $('.delete').zcjyFrameOpenObj('/zcjy/iframe/card/list','批量删除');
    });
   //选择成功callback
   function call_back_by_card_action(arr){
        layer.closeAll();
        $('#delete').find('input[name=card_arr]').val(arr);
        $('#delete').submit();
   }
</script>
@endsection

