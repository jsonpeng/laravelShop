@extends('front.default.layout.base')

@section('css')
    <style>
        .weui-grid{width: 25%;}
        .nav_tip .titile{color: #fff;font-size: 17px;}
        .shareCode{margin-bottom: 0;margin-top:15px;height: auto;}
        .weui-cell__hd img{width:35.5px;margin-left: 60px;margin-right: 10px;}
        .weui-cell__bd{text-align: left;}
        .ft-l{font-size:16px;}
        .ft-s{font-size: 14px;color: #949494;}
    </style>
@endsection

@section('content')
	<div class="nav_tip kefu">
	  <div class="img">
	    <a href="javascript:history.back(-1)"><i class="icon ion-ios-arrow-left"></i></a></div>
	  <p class="titile">客服中心</p>
	  <!--div class="userSet">
	      <a href="javascript:;">
	            <img src="{{ asset('images/default/more.png') }}" alt="">
	      </a>
	  </div-->
	</div>
    

    <a href="/integral/kefulist" class="click_box weui-cell">
        <div class="weui-cell__bd">
            <p class="ft_l">点击咨询客服</p>
            <p class="ft_s">在线咨询时间9:00-17:00</p>
        </div>
    </a>

    <a href="/integral/kefufeedback" class="click_box weui-cell">
        <div class="weui-cell__bd">
            <p class="ft_l">意见反馈客服</p>
            <p class="ft_s">对服务不满或者想说出你的意见请联系我</p>
        </div>
    </a>

    <div class="btn_bottom">客服热线：{!! getSettingValueByKeyCache('service_tel')  !!}</div>
@endsection


@section('js')
    
@endsection