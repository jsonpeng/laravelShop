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
            margin-right: 5px;
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
        form .usersTxt input:nth-child(2){
            margin-left: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="nav_tip">
      <div class="img">
        <a href="javascript:history.back(-1)"><i class="icon ion-ios-arrow-left"></i></a></div>
      <p class="titile">设置性别</p>
    </div>
    <form>
        <div class="usersTxt weui-cell">
            <div class="weui-cell__bd">
                <input type="radio" name="sex"  value="男" @if($user->sex=="男")  checked @endif />男
                <input type="radio" name="sex" value="女" @if($user->sex=="女")  checked @endif  />女
            </div>
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
            $.zcjyRequest('/ajax/update_info',function(res){
                    if(res){
                        alert(res);
                    }
            },$('form').serialize());
        });
    </script>
@endsection





