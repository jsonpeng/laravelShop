@extends('front.default.layout.base')

@section('css')
    <style>
        .weui-grid{width: 25%;}
        .user-zone .weui-cell{border-bottom:1px solid #e0e0e0;}
        body{position: relative;}
        .success{position: absolute;top: 50%;left: 50%;transform: translate(-50%,50%);text-align: center;}
        .success img{width:70px;}
        .success p{color: #09afff;}
        .nav_tip{height: 44px;}
    </style>
@endsection

@section('content')
    <div class="nav_tip">
      <div class="img">
        <a href="/usercenter">
            <i class="icon ion-ios-arrow-left"></i>
        </a></div>
      <p class="titile"></p>
    </div>

    <div class="success">
        <img src="{{ asset('images/trade/done.png') }}" alt="">
        @if($cert->status == '审核中')
        <p>提交成功,请等待审核</p>
        @elseif($cert->status == '已通过')
        <p>您已认证成功</p>
        @endif
    </div>

@endsection

{{-- @if($cert->status == '审核中')
        setTimeout(function(){
            location.href="/usercenter";
        },1000);
 @endif --}}

@section('js')

@endsection