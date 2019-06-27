@extends('front.default.layout.base')

@section('css')
    <style>
        .weui-grid{width: 25%;}
       	.credit-body .g-content .info .weui-flex__item{font-size: 13px;}
       	.credit .credit-body .g-title .weui-flex__item:last-child{flex: 3;}
       	.credit .credit-body .g-content{background-color: #fff;}
       	.credit .credit-body>div:nth-child(even){background-color:#fbfcfb;}
    </style>
@endsection

@section('content')
<div class="nav_tip">
  <div class="img">
    <a href="javascript:history.back(-1)"><i class="icon ion-ios-arrow-left"></i></a></div>
  <p class="titile">意见反馈</p>
</div>
  
<div class="weui-cell">
  <div class="suggest">
      <div class="title">您的反馈是：</div>
      <div class="radios">
        <input name="sex" id="problem" type="radio" value="0" /> 
        <label for="problem">反映问题</label>
        <input name="sex" id="problem1" type="radio" value="1" /> 
        <label for="problem1">提出建议</label>
        <input name="sex" id="problem2" type="radio" value="2" /> 
        <label for="problem2">其他</label>
      </div>
      <div class="title">意见反馈：</div>
      <textarea name="" id="pushSuggest" maxlength="400" placeholder="请输入遇到的问题或建议..."></textarea>
      <div class="wordsNum"><span>0</span>/400</div>
  </div>
</div>

<div class="weui-cell">
    <div class="contact_phone weui-cell__bd">
        <span>联系电话：</span><input type="text" placeholder="请输入您的联系电话">
    </div>
</div>

<div class="btn_bottom">确认提交</div>
@endsection



@section('js')
    <script src="{{ asset('vendor/doT.min.js') }}"></script>

    <script type="text/template" id="template">
        @{{~it:value:index}}
            <div class="g-content scroll-post">
                <div class="info weui-flex">
                    <div class="weui-flex__item">@{{=value.created_at.substring(0,10)}}</div>
                    <div class="weui-flex__item">@{{=value.amount}}</div>
                    <div class="weui-flex__item">@{{=value.change}}</div>
                    <div class="weui-flex__item click-detail">查看详情</div>
                    <div class="weui-flex__item pic">
                        <img class="open" src="{{ asset('images/top.png') }}" alt="">
                        <img class="shut" src="{{ asset('images/bottom.png') }}" alt="">
                    </div>
                </div>
                <div class="detail-txt">
                    @{{=value.detail}}
                </div>
            </div>
        @{{~}}
    </script>

    <script type="text/javascript">

        $(document).ready(function(){
            //无限加载
            var fireEvent = true;
            var working = false;

            $(document).endlessScroll({

                bottomPixels: 250,

                fireDelay: 10,

                ceaseFire: function(){
                  if (!fireEvent) {
                    return true;
                  }
                },

                callback: function(p){

                  if(!fireEvent || working){return;}

                  working = true;

                  //加载函数
                  $.ajaxSetup({ 
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                  });
                  $.ajax({
                    url:"/ajax/bonus?skip=" + $('.scroll-post').length + "&take=18",
                    type:"GET",
                    success:function(data){
                      if (data.code != 0) {
                        return;
                      }

                      if (data.message.length == 0) {
                        fireEvent = false;
                        $('#scroll-container').append("<div id='loading-tips' style='padding: 15px; color: #999; font-size: 14px; text-align: center;'>别再扯了，已经没有了</div>");
                        return;
                      }

                      if (data.message.length) {
                          // 编译模板函数
                          var tempFn = doT.template( $('#template').html() );

                          // 使用模板函数生成HTML文本
                          var resultHTML = tempFn(data.message);

                          // 否则，直接替换list中的内容
                          $('#scroll-container').append(resultHTML);
                        } else {
                          
                        }
                        working = false;
                        }
                  });
                }
            });

            setInterval(function(){
              var num=$('#pushSuggest').val().length;
              if(num>200){
                num=200
              }
              $('.suggest .wordsNum span').html(200-num);
              console.log(num);
            },500); 
        });
    </script>
@endsection