@extends('front.default.layout.base')

@section('css')
    <style>
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
        form .usersTxt .weui-cell__bd{
            border:1px solid #eee;
            border-radius:3px;
            padding-left: 5px;
        }
    </style>
@endsection

@section('content')
    <div class="nav_tip">
      <div class="img">
        <a href="/integral/setting"><i class="icon ion-ios-arrow-left"></i></a></div>
      <p class="titile">修改昵称</p>
    </div>
    <form>
        <div class="usersTxt weui-cell">
            <div class="weui-cell__bd"><input type="text" name="nickname" maxlength="16" placeholder="{!! $user->nickname !!}"></div>
            <div class="weui-cell__ft"></div>
        </div>
    </form>

    <div class="page">
        <div class="page__bd">
            <button class="weui-btn weui-btn_primary set_enter" type="button">保存</button>
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
            $.zcjyRequest('/ajax/update_info',function(res){
                    if(res){
                        alert(res);
                    }
            },$('form').serialize());
        });
    </script>
@endsection





