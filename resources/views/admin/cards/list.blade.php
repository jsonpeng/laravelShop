@extends('admin.layouts.app_tem')

@section('content')
    <section class="content-header">
        <h1 class="pull-left" style="margin-right: 15px;">{{ getSettingValueByKeyCache('credits_alias') }}卡列表</h1>
    </section>

       
    <div class="content">
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                        <a class="select_all">全选</a>
                        <table class="table table-responsive" id="cards-table">
                            <thead>
                                <tr>
                                <th>呗壳卡号</th>
                                <th>密码</th>
                                <th>货呗面额</th>
                                <th>使用状态</th>
                            </thead>
                            <tbody>
                            @foreach($cards as $card)
                                <tr data-id="{!! $card->id  !!}">
                                    <td>{!! $card->number !!}</td>
                                    <td>{!! $card->password !!}</td>
                                    <td>{!! $card->num !!}</td>
                                    <td>{!! $card->status ? '已使用' : '未使用'!!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
            </div>
            <div class="pull-left" style="margin-top:15px;">
                        <input type="button" class="btn btn-primary"  value="批量删除" id="delete">
            </div>
        </div>
        <div class="text-center">
            {!! $cards->appends('')->links() !!}
        </div>
    </div>
@endsection


@section('scripts')
<script type="text/javascript">
$('.select_all').click(function(){
    $('tbody > tr').toggleClass('trSelected');
});
//选择
$('tr').click(function(){
   $(this).toggleClass('trSelected');
});;

$('#delete').click(function(){
    var action = actionFunc();
    if(action){
        javascript:window.parent.call_back_by_card_action(action);
    }
});

function actionFunc(){
         var card_arr=[];
         var selected=$('tr').hasClass('trSelected');
            if(!selected){
               layer.alert('请选择一个列', {icon: 2}); 
               return false;
            }
            $('tr').each(function(){
                if($(this).hasClass('trSelected')){
                   card_arr.push($(this).data('id'));
                   console.log(card_arr);
                }
                else{
                    $(this).remove();
                }
            });
            return card_arr;
}
</script>
@endsection

