@extends('front.default.layout.base')

@section('css')

@endsection

@section('title')
@endsection

@section('content')
	<div class="resetPwd">
		<div class="nav_tip">
		  <div class="img">
		    <a href="javascript:history.back(-1);"><i class="icon ion-ios-arrow-left"></i></a></div>
		  <p class="titile">修改密码</p>
		</div>
		<div class="logo weui-cell">
		    <img src="{{ asset('images/trade/change.png') }}" alt="">
		</div>
		<form >
		    <div class="weui-cells weui-cells_form">
		        <div class="weui-cell">
		            <div class="weui-cell__bd">
		                <input type="text" placeholder="请输入当前密码：">
		            </div>
		        </div>
		        <div class="weui-cell">
		            <div class="weui-cell__bd">
		                <input type="text" placeholder="设置新登录密码：">
		            </div>
		        </div>
		        <div class="weui-cell">
		            <div class="weui-cell__bd">
		                <input type="text" placeholder="确认登录密码：">
		            </div>
		        </div>
		    </div>

		<div class="page">
		    <div class="page__bd page__bd_spacing">
		        <button class="weui-btn weui-btn_primary" type="button" onclick="saveForm()">立即修改</button>
		    </div>
		</div>
	</div>
@endsection


@section('js')


@endsection