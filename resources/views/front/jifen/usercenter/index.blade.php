@extends('front.default.layout.base')

@section('css')
    <style>
        body{background-color:#fff;}
        .weui-grid{width: 25%;}
        .user-zone .weui-cell{border-bottom:1px solid #e0e0e0;}
        .weui-cell .weui-cell__bd{color: #000;font-weight: bold;}
        .userInfo{background-image: url('images/trade/bg_1.jpg');background-repeat: no-repeat;background-position: center;background-size: cover;box-sizing: border-box;padding-bottom: 15px;}
        .userInfo .weui-media-box_appmsg{margin-top:15px;}
        .app-wrapper .userInfo .weui-media-box .weui-media-box__desc span{color: #fff;}
        .userInfo .line{margin: 0 15px;}
        .nav-top a .icon{color: #fff;font-size:30px;}
        .nav-top .weui-cell__bd{text-align: right;}
        .section-margin{margin-bottom: 0;}
        .index-function-grids .weui-grid__icon{
            width:25px;
            height: 25px;
        }
        .index-function-grids .weui-grid__icon span{
            color:#09afff;
            position: absolute;
            top: 3px;
            right: 20px;
            height: 12px;
            width: 12px;
            border-radius: 8px;
            line-height: 12px;
            padding: 0;
            font-size: 10px;
            border:1px solid #09afff;
            background-color: #fff;
        }
    </style>
@endsection

@section('content')
    <div class="userInfo">
{{--         <div class="weui-cell nav-top">
            <a href="javascript:;" class="weui-cell__hd">
                <img class="mail" id="mail" src="{{ asset('images/social/mail.png') }}">
            </a>
            <a class="weui-cell__bd" href="javascript:;">
                <i class="icon ion-ios-gear-outline"></i>
            </a>
        </div> --}}
        <div class="weui-cell head">
            <a class="weui-cell__bd" href="/integral/setting">
                <img src="{{ asset('images/trade/set.png') }}" alt="">
            </a>
        </div>
        <div class="weui-media-box weui-media-box_appmsg">
            <div class="weui-media-box__bd">
                <div class="userImg">
                    <img src="{{ $user->head_image }}" alt="">
                </div>
                <div class="name">{{ $user->nickname }}</div>
                <div class="weui-media-box__title">
                    @if(funcOpen('FUNC_MEMBER_LEVEL') && !empty($userLevel))
                        <div class="menber">
                            <img src="{{ asset('images/vip.png') }}" alt="">
                        </div>
                    @endif
                    {{-- <div class="name">{{ $user->nickname }}</div> --}}
                </div>
                <div class="weui-media-box__desc">
                    @if(funcOpen('FUNC_CREDITS'))<a href="/usercenter/credits"><span>{{ getSettingValueByKeyCache('credits_alias') }}：</span><span>{{ $user->credits }}</span></a>@endif 
                    @if(funcOpen('FUNC_CREDITS') && funcOpen('FUNC_FUNDS'))<span class="line">|</span>@endif 
                    @if(funcOpen('FUNC_FUNDS'))<a href="/usercenter/blances"><span>余额：</span><span>{{ $user->user_money }}</span></a>@endif
                </div>
            </div>
        </div>

    </div>
    <div class="weui-cells section-margin">
        <a class="weui-cell weui-cell_access" href="/orders">
            <div class="weui-cell__bd">
                <p>我的订单</p>
            </div>
            <div class="weui-cell__ft">查看更多订单</div>
        </a>
        <div class="cutLine weui-cell">
            <div class="line"></div>
        </div>
        <div class="weui-grids index-function-grids">
            <a href="/orders/2" class="weui-grid">
                <div class="weui-grid__icon">
                    <img src="{{ asset('images/trade/c1.jpg') }}" alt="">
                    @if($order_nums_arr['待付款'])<span>{!! $order_nums_arr['待付款'] !!}</span>@endif
                </div>
                <p class="weui-grid__label">待付款</p>
            </a>
            <a href="/orders/3" class="weui-grid">
                <div class="weui-grid__icon">
                     <img src="{{ asset('images/trade/c2.jpg') }}" alt="">
                     @if($order_nums_arr['待发货'])<span>{!! $order_nums_arr['待发货'] !!}</span>@endif
                </div>
                <p class="weui-grid__label">待发货</p>
            </a>
            <a href="/orders/4" class="weui-grid">
                <div class="weui-grid__icon">
                     <img src="{{ asset('images/trade/c3.jpg') }}" alt="">
                     @if($order_nums_arr['待收货'])<span>{!! $order_nums_arr['待收货'] !!}</span>@endif
                </div>
                <p class="weui-grid__label">待收货</p>
            </a>
            <a href="/orders/5" class="weui-grid">
                <div class="weui-grid__icon">
                     <img src="{{ asset('images/trade/c4.jpg') }}" alt="">
                     @if($order_nums_arr['我的评价'])<span>{!! $order_nums_arr['我的评价'] !!}</span>@endif
                </div>
                <p class="weui-grid__label">我的评价</p>
            </a>
        </div>
    </div>
    <div class="cutLine weui-cell">
        <div class="line"></div>
    </div>
    <div class="weui-cells section-margin">
        <div class="weui-cell weui-cell_access" >
            <div class="weui-cell__bd">
                <p>常用工具</p>
            </div>
        </div>
        <div class="cutLine weui-cell">
            <div class="line"></div>
        </div>
        <div class="weui-grids index-function-grids">

            @if(funcOpen('FUNC_MANY_SHOP'))
             {{--    <a href="/integral/service_shops" class="weui-grid">
                    <div class="weui-grid__icon">
                         <img src="{{ asset('images/trade/c10.jpg') }}" alt="">
                    </div>
                    <p class="weui-grid__label">服务商户</p>
                </a> --}}
            @endif
            
{{--             <a href="/integral/giving" class="weui-grid">
                <div class="weui-grid__icon">
                     <img src="{{ asset('images/trade/c5.jpg') }}" alt="">
                </div>
                <p class="weui-grid__label">{{ getSettingValueByKeyCache('credits_alias') }}转赠</p>
            </a> --}}
            <a href="/kefu" class="weui-grid">
                <div class="weui-grid__icon">
                     <img src="{{ asset('images/trade/c6.jpg') }}" alt="">
                </div>
                <p class="weui-grid__label">客服中心</p>
            </a>
 {{--            @if(funcOpen('AUTH_CERTS'))
            <a href="/integral/cert" class="weui-grid">
                <div class="weui-grid__icon">
                     <img src="{{ asset('images/trade/c7.jpg') }}" alt="">
                </div>
                <p class="weui-grid__label">实名认证</p>
            </a>
            @endif --}}
{{--             <a href="/integral/myeval" class="weui-grid">
                <div class="weui-grid__icon">
                     <img src="{{ asset('images/trade/c9.jpg') }}" alt="">
                </div>
                <p class="weui-grid__label">我的评价</p>
            </a> --}}
            <a href="/integral/mywallet" class="weui-grid">
                <div class="weui-grid__icon">
                     <img src="{{ asset('images/trade/c8.jpg') }}" alt="">
                </div>
                <p class="weui-grid__label">我的钱包</p>
            </a>
            <a href="/usercenter/mycollections" class="weui-grid">
                <div class="weui-grid__icon">
                     <img src="{{ asset('images/trade/c11.jpg') }}" alt="">
                </div>
                <p class="weui-grid__label">我的收藏</p>
            </a>
{{--             <a href="/address" class="weui-grid">
                <div class="weui-grid__icon">
                     <img src="{{ asset('images/trade/c12.jpg') }}" alt="">
                </div>
                <p class="weui-grid__label">地址管理</p>
            </a> --}}
        </div>
    </div>

    @include(frontView('layout.nav'), ['tabIndex' => 4])
@endsection


@section('js')
    
@endsection