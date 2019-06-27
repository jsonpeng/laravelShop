@extends('front.default.layout.base')

@section('css')
<style>.weui-grid{width: 25%;}</style>
@endsection

@section('content')
<div class="nav_tip">
  <div class="img">
    <a href="javascript:history.back(-1)"><i class="icon ion-ios-arrow-left"></i></a></div>
  <p class="titile">货呗转赠</p>
</div>
<div class="logo weui-cell">
    <img src="{{ asset('images/trade/change.png') }}" alt="">
</div>
<form >
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <input type="text" name="account" placeholder="请输入对方账号(手机号):">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <input type="text" name="password-pay" placeholder="请输入支付密码：">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <input type="number" name="num" placeholder="请输入转赠数量：">
            </div>
        </div>
        <input type="hidden" name="send_credits_bili" value="{!! getSettingValueByKeyCache('send_credits_bili') !!}" />
        <input type="hidden" name="send_credits_min_num" value="{!! getSettingValueByKeyCache('send_credits_min_num') !!}" />
        <input type="hidden" name="current_num" value="" />
        <div class="weui-cell giv-text" >
            <div class="weui-cell__bd">
                <p class="tip">{{ getSettingValueByKeyCache('send_credits_info') }}</p>
            </div>
        </div>
    </div>

<div class="page">
    <div class="page__bd page__bd_spacing">
        <button class="weui-btn weui-btn_primary givingNow" type="button">立即转赠</button>
    </div>
</div>
</form>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('vendor/layer/layer.js') }}"></script>
<script type="text/javascript">
    var credits = '{!! getSettingValueByKeyCache('credits_alias') !!}';
    var text = '{!! getSettingValueByKeyCache('send_credits_info') !!}';
    //输入转赠数量
    $('input[name=num]').keyup(function(){
        var val = $(this).val();
        if(!$.empty(val)){
            val = parseInt(val);
            var bili =parseInt($('input[name=send_credits_bili]').val());
            if(bili){
                 var min_num = parseInt($('input[name=send_credits_min_num]').val());
                 var attach_num = Math.round(val * bili / 100);
                 if(attach_num < min_num){
                    attach_num = min_num;
                 }
                 var current_num = val + attach_num;
                 $('.giv-text').find('.tip').text('服务额外收取'+attach_num+credits+',实际支付'+current_num+credits);
                 $('.giv-text').show();
                 $('input[name=current_num]').val(current_num);
            }
            else{
                $('.giv-text').find('.tip').text(text);
                $('input[name=current_num]').val(val);
            }
        }
        else{
            $('.giv-text').find('.tip').text(text);
        }
    });

    $('.givingNow').click(function(){
        $.zcjyRequest('/ajax/credits/send',function(res){
            if(res){
                alert(res);
                location.href="/usercenter";
            }
        },$('form').serialize());
    });
</script>
</script>
@endsection