<!DOCTYPE html>
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Cache-control" content="no-cache,no-store,must-revalidate">

    @yield('title')
    
    <!-- WEUI -->
    <link rel="stylesheet" href="{{ asset('vendor/weui.min.css') }}">

    <!-- 图标字体 -->
    <link rel="stylesheet" href="{{ asset('ionicons.min.css') }}">

    <!-- 默认样式 -->
    <link rel="stylesheet" href="{{ asset('css/default/app.css') }}">

    <!-- 主题样式 -->
    <link rel="stylesheet" href="{{ asset('css/'.theme()['name'].'/app.css') }}">

    <!-- LAYER UI -->
    <link rel="stylesheet" href="{{ asset('vendor/layui/css/layui.css') }}"  media="all">
    
    <!-- SWIPER 幻灯片 -->
    <link rel="stylesheet" href="{{ asset('vendor/swiper4.22/css/swiper.min.css') }}">
    <style type="text/css">
        #cart_num{
            display: none;
        }
        .app-wrapper{
        height: auto;
        overflow: hidden;
        overflow-y: scroll;
        }
        .app-wrapper::-webkit-scrollbar-track-piece {
          background-color: #FFF;
          border-left: 1px solid #FFF;
        }
        .app-wrapper::-webkit-scrollbar {
          width: 2px;
          height: 5px;
          -webkit-border-radius: 5px;
          -moz-border-radius: 5px;
          border-radius: 5px;
        }
        .app-wrapper::-webkit-scrollbar-thumb {
          background-color: #ccc;
          background-clip: padding-box;
          -webkit-border-radius: 5px;
          -moz-border-radius: 5px;
          border-radius: 5px;
          min-height: 10px;
        }
        .app-wrapper::-webkit-scrollbar-thumb:hover {
          background-color: #ccc;
          -webkit-border-radius: 5px;
          -moz-border-radius: 5px;
          border-radius: 5px;
        }
    </style>
    @yield('css')
    
    <?php $theme_main_color = themeMainColor(); ?>

    @include('front.common.color', ['theme_main_color' => $theme_main_color])

    <!-- jquery -->
    <script src="{{asset('vendor/jquery-1.12.4.min.js')}}"></script>

</head>
<body>

    @include('front.common.layer', ['theme_main_color' => $theme_main_color])

    <div class="app-wrapper">
        @yield('content')
    </div>

</body>
{{-- <!-- jqWeui --> 
<script src="https://cdn.bootcss.com/jquery-weui/1.2.1/js/jquery-weui.min.js"></script> --}}
<!-- 弹出提示 -->
<script src="{{ asset('vendor/layer/mobile/layer.js') }}"></script>

<!-- 滚动 -->
<script src="{{ asset('vendor/swiper4.22/js/swiper.min.js') }}"></script>

<!-- 倒数计时 -->
<script src="{{ asset('js/default/timer.js') }}"></script>

<!-- 无限加载 -->
<script src="{{ asset('vendor/jquery.endless-scroll-1.3.js') }}"></script>

<!-- 图片缓加载 -->
<script src="{{ asset('vendor/jquery.lazyload.js') }}"></script>

<!-- 自定义代码 -->
<script src="{{ asset('js/default/main.js') }}"></script>

<!-- jquery扩展 -->
<script src="{{ asset('js/zcjy.js') }}"></script>

<!-- xback -->
{{-- <script type="text/javascript" src="{{ asset('js/xback.js') }}"></script> --}}

@yield('js')
{{-- <script type="text/javascript" src="{{ asset('vendor/scroll/scrollbot.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/scroll/scrollreveal.min.js') }}"></script>
<script type="text/javascript">
    var custom = new scrollbot("body");
    custom.setStyle({height:2});
    var onscrollfollower = document.createElement("div");
    onscrollfollower.style.width = "100%";
    onscrollfollower.style.height = "100%";
    onscrollfollower.style.backgroundColor = "#4c84ff";
    onscrollfollower.style.position = "absolute";
    onscrollfollower.style.bottom = "100%";
    onscrollfollower.style.right = 0;
    custom.scrollBarHolder.appendChild(onscrollfollower);
    custom.onScroll(function(){onscrollfollower.style.bottom = 100 - parseFloat(this.scrollBar.style.top) + "%";});
    document.onreadystatechange = function(){
      
        custom.refresh();
   
    }
</script> --}}
<script>
    $("img.lazy").lazyload({effect: "fadeIn"});
    //document.body.parentNode.style.overflowY = "hidden";
   // $("body").parent().css("overflow-y","hidden");
    // new Swiper('.swiper-container', {
    //     speed: 300,
    //     spaceBetween: 0,
    //     // Disable preloading of all images
    //     preloadImages: false,
    //     // Enable lazy loading
    //     lazy: true
    // });

    $('.history-back-a').click(function(){
        history.back(-1);
    });

    @if(Request::is('/') || Request::is('category*') || Request::is('usercenter*') || Request::is('orders*'))
        window.onpageshow = function(){
            setTimeout(function(){
                   $.zcjyRequest('/ajax/shop_cart_num',function(res){
                    if(res){
                        $('#cart_num').show().text(res);
                    }
               });
            },1);
        }
    @endif 


</script>
</html>