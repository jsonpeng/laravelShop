@extends('front.default.layout.base')

@section('css')
<style>.weui-grid{width: 25%;}</style>
@endsection

@section('content')
<div class="nav_tip">
  <div class="img">
    <a href="javascript:history.back(-1)"><i class="icon ion-ios-arrow-left"></i></a></div>
  <p class="titile">呗壳转赠</p>
</div>
<div class="logo weui-cell">
    <img src="{{ asset('images/trade/change.png') }}" alt="">
</div>
<form >
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <input type="text" placeholder="请填写对方账号：">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <input type="text" placeholder="请输入密码：">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <input type="text" placeholder="请输入金额：">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <p class="tip">注：需支付转赠金额1%的呗壳，请保证呗壳金额充足</p>
            </div>
        </div>
    </div>

<div class="page">
    <div class="page__bd page__bd_spacing">
        <button class="weui-btn weui-btn_primary" type="button" onclick="saveForm()">立即转赠</button>
    </div>
</div>
</form>
@endsection

@section('js')
<script type="text/javascript">
function saveForm(){
    var tpye=$('#card_type').val();
    if($('input[name=bank_name]').val()!='' && $('input[name=user_name]').val()!='' && $('input[name=count]').val()!=''){
            var reg_count = /^\d{19}$/g; 
            if(tpye==1){
                reg_count= /^\d{16}$/g; 
                console.log('选择了信用卡');
            }
            if(!reg_count.test($('input[name=count]').val())){
                  layer.open({
                    content: '银行卡格式不正确'
                    ,skin: 'msg'
                    ,time: 2 
                  });
                  return false;
            }
            // var reg_mobile = /^1[3|4|5|7|8][0-9]{9}$/;
            // if(!reg_mobile.test($('input[name=mobile]').val())){
            //           layer.open({
            //         content: '手机号格式不正确'
            //         ,skin: 'msg'
            //         ,time: 2 
            //       }); 
            //       return false; 
            // }
    $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
    $.ajax({
                url:'/api/bank_info/save',
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                  if(data.code==0){
                        layer.open({
                    content: '保存成功'
                    ,skin: 'msg'
                    ,time: 2 
                  });
                  location.href=data.message;
                  }else{
                    layer.open({
                    content: '参数填写不完整'
                    ,skin: 'msg'
                    ,time: 2 
                  });
                  return false;
                  }
                }
              });
        }else{
                  layer.open({
                    content: '参数填写不完整'
                    ,skin: 'msg'
                    ,time: 2 
                  });
        }
}
</script>
@endsection