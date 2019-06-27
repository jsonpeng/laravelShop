@extends('front.default.layout.base')

@section('css')
    <style>
        body{
            background-color:#fff;
        }
        .weui-grid{width: 25%; margin-top: 1rem;overflow: hidden;}
        .weui-grid__icon{width: 40px; height: 40px;}
        .weui-grid__icon img{width: 40px; height: 40px;}
        .weui-grid .weui-grid__label{/* text-overflow: inherit;overflow:visible; */height: 20px;line-height: 20px;}
        input{
            outline: 0;
            border:0;
            width:100%;
        }
        .page{
            position: absolute;
            bottom: 0;
            width:100%;
        }
        .page .page__bd button{
            border-radius:0;
        }
        form .usersTxt{
            padding:10px 15px;
        }
        .myset{
            line-height:40px;
            padding:0 15px;
        }
        .myset .weui-cell__hd{
            width:20px;
            height: 20px;
            margin:0 10px;
        }
        .myset .weui-cell__hd img{
            display: block;
            width:100%;
        }
        .usersTxt .weui-cell__hd{
            margin:0 10px;
        }
    </style>
@endsection

@section('content')
    <div class="nav_tip">
      <div class="img">
        <a href="javascript:history.back(-1)"><i class="icon ion-ios-arrow-left"></i></a></div>
      <p class="titile">设置</p>
    </div>
    <form>
        <div class="usersTxt weui-cell weui-cell_access">
            <div class="weui-cell__hd">
                <img src="{!! $user->head_image !!}" onerror="javascript:this.src='/images/trade/n1.jpg';" alt="">
            </div>
            <a class="weui-cell__bd" href="set_nickname">{!! $user->nickname !!}</a>
            <div class="weui-cell__ft"></div>
        </div>

{{--         <a class="weui-cell myset weui-cell_access" href="set_sex">
            <div class="weui-cell__hd">
                <img src="{{ asset('images/trade/c13.jpg') }}" alt="">
            </div>
            <div class="weui-cell__bd"><p>性别</p></div>
            <div class="weui-cell__ft"></div>
        </a> --}}

        <a class="weui-cell weui-cell_access myset" href="/address">
            <div class="weui-cell__hd">
                <img src="{{ asset('images/trade/c13.jpg') }}" alt="">
            </div>
            <div class="weui-cell__bd">
                <p>地址管理</p>
            </div>
            <div class="weui-cell__ft"></div>
        </a>
        <a class="weui-cell myset weui-cell_access" href="set_mobile">
            <div class="weui-cell__hd">
                <img src="{{ asset('images/trade/c14.jpg') }}" alt="">
            </div>
            <div class="weui-cell__bd">
                <p>我的联系电话</p>
            </div>
            <div class="weui-cell__bd"></div>
            <div class="weui-cell__ft"></div>
        </a>
    </form>
{{--     <a class="weui-cell weui-cell_access myset" href="/integral/edit_password">
        <div class="weui-cell__bd">
            <p>修改登录密码</p>
        </div>
        <div class="weui-cell__ft"></div>
    </a> --}}
    <a class="weui-cell weui-cell_access myset" href="/integral/set_pay_pwd">
        <div class="weui-cell__hd">
            <img src="{{ asset('images/trade/c15.jpg') }}" alt="">
        </div>
        <div class="weui-cell__bd">
            <p>{!! empty($user->{'password-pay'}) ? '设置' : '修改' !!}支付密码</p>
        </div>
        <div class="weui-cell__ft"></div>
    </a>

    <a class="weui-cell weui-cell_access myset" href="/integral/cert">
        <div class="weui-cell__hd">
            <img src="{{ asset('images/trade/c7.jpg') }}" alt="">
        </div>
        <div class="weui-cell__bd">
            <p>实名认证</p>
        </div>
        <div class="weui-cell__ft"></div>
    </a>
    
    <div class="page">
        <div class="page__bd">
            <button class="weui-btn weui-btn_primary set_enter" type="button">确认修改</button>
        </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript">
        $('.set_enter').click(function(){
            if($.empty($('input[name=nickname]').val())){
                alert('请输入昵称');
                return;
            }
            if($.empty($('input[name=mobile]').val())){
                alert('请输入联系电话');
                return;
            }
            $.zcjyRequest('/ajax/update_info',function(res){
                    if(res){
                        alert(res);
                    }
            },$('form').serialize());
        });
    </script>
@endsection





