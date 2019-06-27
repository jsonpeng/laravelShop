@extends('front.default.layout.base')

@section('css')
    <style>
        .weui-grid{width: 25%; margin-top: 1rem;overflow: hidden;}
        .weui-grid__icon{width: 40px; height: 40px;}
        .weui-grid__icon img{width: 40px; height: 40px;}
        .weui-grid .weui-grid__label{/* text-overflow: inherit;overflow:visible; */height: 20px;line-height: 20px;}
    </style>
@endsection

@section('content')
    <div class="nav_tip">
      <div class="img">
        <a href="javascript:history.back(-1)"><i class="icon ion-ios-arrow-left"></i></a></div>
      <p class="titile">设置</p>
    </div>
    
    <div class="usersTxt weui-cell">
        <div class="weui-cell__hd">
            <img src="{{ asset('images/trade/n1.jpg') }}" alt="">
        </div>
        <div class="weui-cell__bd">用户名</div>
        <div class="weui-cell__ft"><a href="/address">修改用户名</a></div>
    </div>

    <a class="weui-cell weui-cell_access myset" href="/address">
        <div class="weui-cell__bd">
            <p>我的收货地址</p>
        </div>
        <div class="weui-cell__ft"></div>
    </a>
    <a class="weui-cell weui-cell_access myset" href="/address">
        <div class="weui-cell__bd">
            <p>我的联系电话</p>
        </div>
        <div class="weui-cell__ft"></div>
    </a>
    <a class="weui-cell weui-cell_access myset" href="/integral/edit_password">
        <div class="weui-cell__bd">
            <p>修改登录密码</p>
        </div>
        <div class="weui-cell__ft"></div>
    </a>
    <a class="weui-cell weui-cell_access myset" href="/integral/set_pay_pwd">
        <div class="weui-cell__bd">
            <p>设置支付密码</p>
        </div>
        <div class="weui-cell__ft"></div>
    </a>
@endsection

@section('js')
    
@endsection





