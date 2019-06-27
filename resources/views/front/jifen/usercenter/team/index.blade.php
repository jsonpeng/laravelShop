@extends('front.default.layout.base')
@section('css')
<style></style>
@endsection
@section('content')
    <div class="nav_tip">
        <div class="img">
            <a href="javascript:history.back(-1)"><i class="icon ion-ios-arrow-left"></i></a></div>
        <p class="titile">充值{{ getSettingValueByKeyCache('credits_alias') }}</p>
     </div>
    <div class="logo weui-cell">
        <img src="{{ asset('images/trade/cardPay.png') }}" alt="">
    </div>
    <form >
        <div class="weui-cells weui-cells_form">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <input type="text" placeholder="请填写呗壳卡号：">
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <input type="text" placeholder="请输入密码：">
                </div>
            </div>
        </div>

    <div class="page">
        <div class="page__bd page__bd_spacing">
            <button class="weui-btn weui-btn_primary" type="button" onclick="saveForm()">立即充值</button>
        </div>
    </div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <p class="tip">（注：呗壳充值成功后，24小时内激活，如有疑问可联系客服热线：400）</p>
            </div>
        </div>
    </div>
    </form>
@endsection

@section('js')
<script type="text/javascript">
    $(function(){
        $('.order-item').each(function(){
            var end_time=$(this).data('endtime');
            startShowCountDown(end_time,$(this).find('.teamsale_timer'),'teamsale');
        });
    });
</script>

@endsection