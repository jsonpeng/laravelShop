@extends('front.default.layout.base')

@section('css')
    <style type="text/css">
        .product-wrapper .title{overflow: hidden;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            padding:0 3px;
        }
        .product-wrapper.country-sum{background-color:#fff;}
        .index-function-grids{
            padding:10px 0;
            background-color:#fff;
        }
        .card_swiper .swiper-slide{margin-bottom: 20px;} 
        .card_swiper {
            margin: 0 auto;
            position: relative;
            overflow: hidden;
            list-style: none;
            padding: 0;
            z-index: 1;
        }
        .swiper-container-horizontal>.swiper-pagination-bullets, .swiper-pagination-custom, .swiper-pagination-fraction{
            bottom: -2px;
        }
    </style>
@endsection

@section('title')
@endsection

@section('content')
    @include(frontView('layout.nav'), ['tabIndex' => 1])
    {{-- 搜索框 --}}
    <div class="search_top weui-cell">
        <div class="weui-cell__hd">
            易呗
        </div>
        <div class="weui-cell__bd">
            <div class="weui-search-bar" id="searchBar">
                <form class="weui-search-bar__form">
                    <div class="weui-search-bar__box">
                        <i class="weui-icon-search"></i>
                        <input type="search" class="weui-search-bar__input" id="searchInput" placeholder="搜索" required/>
                        <a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
                    </div>
                    <label class="weui-search-bar__label" id="searchText">
                        <i class="weui-icon-search"></i>
                        <span>输入要搜索的内容</span>
                    </label>
                </form>
                <a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
            </div>
        </div>
        <div class="weui-cell__ft">
            <a href="/integral/near_shops">
               <img src="{{ asset('images/trade/locaiton.png') }}" class="locaiton" alt=""> 
            </a>
            <a href='/integral/message' class='message'>
              <img   src="{{ asset('images/trade/kefu.png') }}"></img>
              @if($unread_messages_num )
              <span>{!! $unread_messages_num !!}</span>
              @endif
            </a>
        </div>

        <div class="weui-cells searchbar-result" id="searchResult">
        </div>
    </div>

    {{-- 轮播图 --}}
    <?php
        $banners = banners('index');
        $count = $banners->count();
    ?>
    @if ($count)
        <div class="swiper-container swiper-container2">
            <div class="swiper-wrapper">
                @foreach ($banners as $element)
                <!-- Lazy image -->
                <a class="swiper-slide" @if($element->link) href="{{ $element->link }}" @else href="javascript:;" @endif>
                    <img data-src="{{ $element->image }}" class="swiper-lazy">
                    <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                </a>
                @endforeach
            </div>
        </div>

    @endif
    {{-- 业务板块 --}}
    <div class="index-function-grids">
        <div class="card_swiper swiper-container">
            <div class="swiper-wrapper">
                <?php
                    $cats = cat_level01();
                ?>
                @foreach ($cats as $element)
                    <a href="/category/level1/{{ $element->id }}" class="swiper-slide">
                        <div class="weui-grid__icon">
                            <img src="{{ $element->image }}" alt="">
                        </div>
                        <p class="weui-grid__label">{{ $element->name }}</p>
                    </a>
                @endforeach
           {{--      @if(funcOpen('FUNC_MANY_SHOP'))
                    <a href="/integral/service_shops" class="swiper-slide">
                        <div class="weui-grid__icon">
                            <img onrror="javascript:this.src='{{ asset('images/trade/change9.png') }}';" src="{!! getSettingValueByKeyCache('company_logo') !!}" alt="">
                        </div>
                        <p class="weui-grid__label">企业店铺</p>
                    </a>
                @endif --}}
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>

{{--         @if(funcOpen('FUNC_MANY_SHOP'))
            <a href="/integral/service_shops" class="weui-grid ">
                <div class="weui-grid__icon">
                    <img onrror="javascript:this.src='{{ asset('images/trade/change9.png') }}';" src="{!! getSettingValueByKeyCache('company_logo') !!}" alt="">
                </div>
                <p class="weui-grid__label">企业店铺</p>
            </a>
        @endif --}}
        
    </div>
    <!-- 资讯 -->
    <?php
        $notices = notices();
    ?>
    @if ($notices->count())
        <div class="weui-cell notice">
            <div class="weui-cell__hd">
                <img src="{{ asset('images/trade/notice.jpg') }}" alt="">
            </div>
            <div class="weui-cell__bd txtScroll-top txtMarquee-top">
                <div class="swiper-container1  bd">
                  <div class="swiper-wrapper infoList">
                    @foreach ($notices as $element)
                        <a class="swiper-slide" href="/notices/{{ $element->id }}">
                            <span class="content">{{ $element->name }}</span>
                            <?php $images = get_content_img($element->content); $image = isset($images[0])?$images[0]:'';?>
                            <img  data-src="{!! $image !!}" onerror="javascript:this.src='/images/trade/n1.jpg';" src="{{ $image }}" alt="">
                        </a>
                    @endforeach
                  </div>
                </div>
            </div>
            
        </div>
    @endif

     @if(funcOpen('FUNC_MANY_SHOP'))
            <?php $stores = stores(); ?>
            @if ($stores->count())
         {{--        <div class="weui-cell store">
                    <div class="weui-cell__bd">
                        服务商户
                    </div>
                    <a class="weui-cell__ft" href="/integral/service_shops">查看更多></a>
                </div>
                
                <div class="product-wrapper country-sum options">
                    <div class="slide-box">
                        <div class="slide-warp">
                            <div class="slide-item" style="height: 85px;display: flex;flex-direction:column;flex-wrap:wrap;border:0;">
                                @foreach ($stores as $element)
                                    <a href="/integral/company_shop/{!! $element->id !!}">
                                    {{ $element->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div> --}}
            @endif
    @endif 

    <?php
        $stores = storeWithProducts(0, 18);
    ?>
    <div id="stores">
        @foreach ($stores as $element) 
            <div class="store_intr scroll-post">
                <img src="{{ $element->image }}" alt="">
            </div>
            <div class="product-wrapper country-sum ">
                    <div class="slide-box">
                        <div class="slide-warp">
                        @foreach ($element->products as $element2)
                            
                            <a class="slide-item" href="/product/{{ $element2->id }}">
                                <div class="img">
                                    <img src="{{ $element2->image }}">
                                </div> 
                                <div class="title">{{ $element2->name }}</div>
                                <div class="price">¥<span style="color: #ff4e44;">{{ $element2->price }}</span>@if($element2->jifen)+{{ getSettingValueByKeyCache('credits_alias') }}<span style="color: #ff4e44;">{{ $element2->jifen }}</span>@endif</div>
                            </a>
                                    
                        @endforeach
                        </div>
                    </div>
                </div>
            
        @endforeach
    </div>

    
    @include('front.'.theme()['name'].'.layout.shopinfo')


    
@endsection


@section('js')

<script src="{{ asset('vendor/doT.min.js') }}"></script>
<script src="{{ asset('vendor/underscore-min.js') }}"></script>

<script type="text/template" id="template">
    @{{~it:value:index}}
        <a class="product-item3 scroll-post" href="/product/@{{=value.id}}">
            <div class="img">
                <img src="@{{=value.image}}">
            </div> 
            <div class="title">@{{=value.name}}</div>
            @{{? value.realPrice }}
                <div class="price">¥@{{=value.realPrice}} <span class="cross">¥@{{=value.price}}</span></div>
            @{{??}}
                <div class="price">¥@{{=value.price}} </div>
            @{{?}}
        </a>
    @{{~}}
</script>


<script type="text/template" id="template-store">
    @{{~it:value:index}}
        <div class="store_intr scroll-post">
            <img src="@{{=value.image}}" alt="">
        </div>
        @{{~it.products:value2:index2}}
        <div class="product-wrapper country-sum ">
            <div class="slide-box">
                <div class="slide-warp">
                    <a class="slide-item" href="/product/1">
                        <div class="img">
                            <img src="@{{=value2.image}}">
                        </div> 
                        <div class="title">@{{=value2.name}}</div>
                        <div class="price">¥<span style="color: #ff4e44;">59.9</span>+{{ getSettingValueByKeyCache('credits_alias') }}<span style="color: #ff4e44;">20</span></div>
                    </a>
                </div>
            </div>
        </div>
         @{{~}}
    @{{~}}
</script>

<script type="text/template" id="template-search">
    @{{~it:value:index}}
        <a class="weui-cell weui-cell_access" href="/product/@{{=value.id}}">
            <div class="weui-cell__bd weui-cell_primary">
                <p>@{{=value.name}}</p>
            </div>
        </a>
    @{{~}}
</script>


<script type="text/javascript">
    $(document).ready(function(){

       {{-- //秒杀倒计时
        @if(funcOpen('FUNC_FLASHSALE') && $flashSaleProduct->count())
            var end_time='{!! $time !!}';
            startShowCountDown(end_time,'#count_timer','flashsale_index');
        @endif
        --}}

        //无限加载
        // var fireEvent = true;
        // var working = false;

        // $(document).endlessScroll({

        //     bottomPixels: 250,

        //     fireDelay: 10,

        //     ceaseFire: function(){
        //       if (!fireEvent) {
        //         return true;
        //       }
        //     },

        //     callback: function(p){

        //       if(!fireEvent || working){return;}

        //       working = true;

        //       //加载函数
        //       $.ajaxSetup({ 
        //         headers: {
        //           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //       });
        //       $.ajax({
        //         url:"/api/stores?skip=" + $('.scroll-post').length + "&take=18",
        //         type:"GET",
        //         success:function(data){
        //             working = false;
        //             var all_product=data.data;
        //             if (all_product.length == 0) {
        //                 fireEvent = false;
        //                 $('#shopinfo').show();
        //                 return;
        //             }

        //           // 编译模板函数
        //           var tempFn = doT.template( $('#template').html() );

        //           // 使用模板函数生成HTML文本
        //           var resultHTML = tempFn(all_product);

        //           // 否则，直接替换list中的内容
        //           $('.scroll-container').append(resultHTML);

        //           //$("img.lazy").lazyload({effect: "fadeIn"});

        //         }

        //       });
        //     }
        // });
    });


    $('.price-btn').click(function(){
        var id=$(this).data('id');
        var status=$(this).data('status');
        var that=this;
        if(!status){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:'/api/userGetCoupons/'+id,
                type:'post',
                success:function(data){
                    if(data.code==0){
                        layer.open({
                        content:data.message
                        ,skin: 'msg'
                        ,time: 2 
                      });
                    $(that).text('已领取');
                    $(that).data('status',true);
                    $(that).attr("style","background-color:#ddd !important;");
                    }else{
                    layer.open({
                        content:data.message
                        ,skin: 'msg'
                        ,time: 2 
                      });
                    }
                }
            });
        }else{
            return false;
        }

    });
    // 滚动页面时让input输入框失去焦点
    var isIPHONE = navigator.userAgent.toUpperCase().indexOf('IPHONE')!= -1;

    // 元素失去焦点隐藏iphone的软键盘

    function objBlur(obj,time){
        var that;
    //  if(typeof id != 'string') throw new Error('objBlur()参数错误');
            time = time || 100,
            docTouchend = function(event){
                    if(event.target!= obj){
                        setTimeout(function(){
                            if (typeof($(event.target).attr("readonly"))!=="undefined") {
                                obj[that].blur();
                                document.removeEventListener('touchmove', docTouchend,false);
                                return false;
                            }
                        },time);
                    }
            };
            if(obj){
                for (var i = 0; i<obj.length; i++) {
                    obj[i].index = i;
                    obj[i].addEventListener('focus', function(){
                        that = this.index;
                        document.addEventListener('touchmove', docTouchend,false);
                    },false);
                }
            }else{
                throw new Error('objBlur()没有找到元素');
            }
    }

    $(function () {
        if(isIPHONE){
            var obj = document.getElementsByTagName('input');
            var input = new objBlur(obj);
            input=null;
        }
    })

      window.onload = function() {
            document.querySelector('body').addEventListener('touchmove', function(e) {
                if(e.target.className != 'weui-search-bar__input') {
                    document.querySelector('#searchInput').blur();
                }
            });
     
      }
    @include('front.common.search.js')

</script>

{{-- 资讯信息 --}}
<script type="text/javascript" src="{{  asset('js/jquery.SuperSlide.2.1.1.js') }}"></script>
<script>
    var Swiper1 = new Swiper('.swiper-container2', {
        speed: 300,
        spaceBetween: 0,
        // Disable preloading of all images
        preloadImages: false,
        // Enable lazy loading
        lazy: true
    });
    var mySwiper1 = new Swiper('.swiper-container1', {
        direction : 'vertical',
        loop : true,
        speed: 1000,
        autoplay: {
          delay: 3000,//1秒切换一次
        },
    })
    // $(".txtMarquee-top").slide({mainCell:".bd",autoPlay:true,effect:"topMarquee",interTime:50,trigger:"click"});
    // var swiper3 = new Swiper ('.card_swiper', {
    //     slidesPerView:4,
    //     slidesPerGroup : 8,
    //     slidesPerColumn : 2,
    //     paginationClickable:true,
    // });
</script>
{{-- <script src="{{ asset('vendor/swiper4.22/js/swiper.min.js') }}"></script> --}}
<script>
    var swiper_1 = new Swiper ('.card_swiper', {
        pagination: {
            el: '.swiper-pagination',
          },
        slidesPerView:4,
        slidesPerGroup : 8,
        slidesPerColumnFill : 'column',
        slidesPerColumn : 2,
        paginationClickable:true,
    });
    console.log($.varifyInWeixin());
</script>
@endsection