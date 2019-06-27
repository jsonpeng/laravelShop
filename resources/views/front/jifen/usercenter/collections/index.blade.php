@extends('front.default.layout.base')

@section('css')
<style></style>
@endsection

@section('content')
  <div class="nav_tip">
    <div class="img">
      <a href="javascript:history.back(-1)"><i class="icon ion-ios-arrow-left"></i></div></a>
    <p class="titile">实名认证</p>
  </div>

  <div class="real_name weui-cell">
    <div class="weui-cell__bd">
      <p><span>*</span>请填写真实姓名：</p><input type="text" placeholder="真实姓名">
    </div>
  </div>
  <div class="idCard weui-cell">
    <div class="weui-cell__bd">
      <p><span>*</span>请输入身份证号码：</p><input type="text" placeholder="身份证号码">
    </div>
  </div>

  <div class="postImg weui-cell">
    <div class="weui-cell__bd">
        <p><span>*</span>上传身份证照片：</p>
        <div class="idCardImg">
            <div class="cardImgItem">
              <img src="{{ asset('images/trade/front.jpg') }}" alt="">
            </div>
            <div class="cardImgItem">
              <img src="{{ asset('images/trade/back.jpg') }}" alt="">
            </div>
        </div>
    </div>
  </div>

  <div class="weui-cell imgRequire">
     <div class="weui-cell__bd">
        <p>拍摄要求：</p>

        <div class="wrongImg">
            <div class="wrongImgItem">
                <img src="{{ asset('images/trade/require1.jpg') }}" alt="">
            </div>
            <div class="wrongImgItem">
                <img src="{{ asset('images/trade/require2.jpg') }}" alt="">
            </div>
            <div class="wrongImgItem">
                <img src="{{ asset('images/trade/require3.jpg') }}" alt="">
            </div>
            <div class="wrongImgItem">
                <img src="{{ asset('images/trade/require4.jpg') }}" alt="">
            </div>
        </div>
     </div>
  </div>

  <div class="postImg  weui-cell">
    <div class="weui-cell__bd">
        <p><span>*</span>上传手持身份证照片：</p>
        <div class="idCardImg">
            <div class="cardImgItem">
              <img src="{{ asset('images/trade/hold.jpg') }}" alt="">
            </div>
            <div class="cardImgItem tackphoto">
              <img src="{{ asset('images/trade/camare.jpg') }}" alt="">
            </div>
        </div>
    </div>
  </div>

  <div class="btn_bottom">提交审核</div>
@endsection


@section('js')
<script type="text/javascript"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.1.2/js/jquery-weui.min.js"></script>
<script src={{ asset('vendor/hammer.js') }}></script>

<script src="{{ asset('vendor/doT.min.js') }}"></script>

<script type="text/template" id="template">
    @{{~it:value:index}}
      <div class="weui-cell weui-cell_swiped order-item scroll-post">
        <div class="weui-cell__bd" style="transform: translate3d(0px, 0px, 0px);">
          <a class="weui-media-box weui-media-box_appmsg" href="/product/@{{=value.id}}">
            <div class="weui-media-box_hd">
              <img class="weui-media-box__thumb" src="@{{=value.image}}" alt=""></div>
            <div class="weui-meida-box_bd">
              <h4 class="weui-media-box_title">@{{=value.name}}</h4>
              <p class="weui-media-box__desc">
                <span class="price">¥@{{=value.price}}</span>
                <span class="num">已有@{{=value.sales_count}}人购买</span>
              </p>
            </div>
          </a>
        </div>
        <div class="weui-cell__ft">
          <div class="weui-swiped-btn weui-swiped-btn_warn delete-swipeout" data-id="@{{=value.id}}">取消收藏</div>
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
                url:"/ajax/collections?skip=" + $('.scroll-post').length + "&take=18",
                type:"GET",
                success:function(data){
                  if (data.code != 0) {
                    return;
                  }

                  var coupons=data.message;

                  if (coupons.length == 0) {
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
    });
</script>

<script>
    
      $('.delete-swipeout').click(function () {
         var product_id=$(this).data('id');
          var that=this;
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
              url:"/ajax/collect_or_cancel/"+product_id,
              type:"POST",
              success:function(data){
                 if(data.code==3){
                      $(that).parents('.weui-cell').remove();
                }else{
                     layer.open({
                      content:data.message
                      ,skin: 'msg'
                      ,time: 2 
                    });
                     return false;
                }
              }
          });
      
      })
      $('.close-swipeout').click(function () {
        $(this).parents('.weui-cell').swipeout('close')
      });

      $(document).ready(function($) {
          document.addEventListener("DOMContentLoaded", function () {
              var myElement = document.querySelector('.weui-cell_swiped');
              var hammertime= new Hammer.Manager(myElement);
              hammertime.on('pan', function(ev) {
                  console.log(ev);
              });
          });
      });

</script>
@endsection