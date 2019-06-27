@extends('front.default.layout.base')

@section('css')
    <style>
        .weui-grid{width: 25%;}
        .user-zone .weui-cell{border-bottom:1px solid #e0e0e0;}
    </style>
@endsection

@section('content')
    <div class="nav_tip">
      <div class="img">
        <a href="javascript:history.back(-1)">
            {{-- <img class="mail" id="mail" src="{{ asset('images/social/mail.png') }}"> --}}
            <i class="icon ion-ios-arrow-left"></i>
        </a></div>
      <p class="titile">企业店铺</p>
    </div>

    <div class="advertising">
        <img src="{{ asset('images/trade/show1.jpg') }}" alt="">
    </div>

    <div class="site weui-cell">
        <div class="weui-cell__hd">
            <img src="{{ asset('images/trade/blue.png') }}" alt="">
        </div>
        <div class="weui-cell__bd">
            <p class="companyName">企业店铺名称</p>
            <p class="address">湖北省武汉市光谷广场资本大厦A座405室</p>
        </div>
        <div class="weui-cell__ft">查看地图</div>
    </div>
    

    <div class="product-wrapper scroll-container"  id="product-box">
        <a class="product-item2 scroll-post" href="/product">
            <div class="img">
                <img class="lazy" data-original="{{asset('images/trade/p1.jpg') }}">
            </div> 
            <div class="title">商品名称</div>
                <div class="price"><b>¥ </b>59.9<b>+贷呗 </b>20 <span>已售 678</span></div>
        </a>
        <a class="product-item2 scroll-post" href="/product">
            <div class="img">
                <img class="lazy" data-original="{{asset('images/trade/p1.jpg') }}">
            </div> 
            <div class="title">商品名称</div>
                <div class="price"><b>¥ </b>59.9<b>+贷呗 </b>20 <span>已售 678</span></div>
        </a>
        <a class="product-item2 scroll-post" href="/product">
            <div class="img">
                <img class="lazy" data-original="{{asset('images/trade/p1.jpg') }}">
            </div> 
            <div class="title">商品名称</div>
                <div class="price"><b>¥ </b>59.9<b>+贷呗 </b>20 <span>已售 678</span></div>
        </a>
    </div>
@endsection


@section('js')
    <script type="text/javascript" class="uploader js_show">
        $(function(){
            var $gallery = $("#gallery"), $galleryImg = $("#galleryImg"),
                $uploaderFiles = $(".pic-show-list");

            $uploaderFiles.on("click", " .pic-show .img img", function(){
                $galleryImg.attr("src", this.getAttribute("src"));
                console.log($galleryImg);
                // console.log($galleryImg.attr("src"));
                // console.log(this.getAttribute("src"));
                $gallery.fadeIn(100);
            });
            $gallery.on("click", function(){
                $gallery.fadeOut(100);
            });
        });
    </script>
    <script type="text/template" id="template">
        @{{~it:value:index}}
           <div class="user-share-content scroll-item">
                <div class="weui-cell">
                    <div class="weui-cell__hd user-img">
                        @{{? value.admin != null || value.user.head_image == null }}
                            <img src="/images/social/brand.jpg" alt="">
                        @{{??}}
                            <img src="@{{=value.user.head_image}}" alt="">
                        @{{?}}
                    </div>
                    <div class="weui-cell__bd">
                        @{{? value.admin != null }}
                             <p class="share-name">@{{=value.admin.name}}</p>
                        @{{??}}
                             <p class="share-name">@{{=value.user.nickname}}</p>
                        @{{?}}
                        <p class="date">@{{=value.humanTime}}</p>
                    </div>
                </div>

                <div class="weui-cell">
                    <div class="weui-cell__hd text">
                        @{{=value.content}}
                    </div>
                </div>

                <div class="weui-cell">
                    <div class="pic-show-list">
                            @{{~value.images:value2:index2}}
                                <div class="pic-show">
                                    <div class="img">
                                      <img src="@{{=value2.url}}" alt="">
                                    </div>
                                </div>
                            @{{~}}
                    </div>
                </div>

                    @{{~value.products:value3:index3}}
                           @{{? value3.specs != null }}
                            <!--有商品规格的商品-->
                                <a class="weui-cell share-link" href="/product/@{{=value3.id}}" >
                                    <div class="weui-cell__hd">
                                        @{{? value3['image'] != null }}
                                            <img src="@{{=value3.image}}" alt="">
                                        @{{?}}
                                    </div>
                                    <div class="weui-cell__bd">
                                         @{{~value3.specs:value4:index4}}
                                                @{{? value3['pivot']['spec_price_id'] == value4['id'] }}
                                                   【 @{{=value4.key_name}}】
                                                @{{?}}
                                          @{{~}}@{{=value3.name}}
                                    </div>
                                </a>
                            @{{??}}
                            <!--没有商品规格的商品-->
                                <a class="weui-cell share-link" href="/product/@{{=value3.id}}">
                                    <div class="weui-cell__hd">
                                        @{{? value3['image'] != null }}
                                            <img src="@{{=value3.image}}" alt="">
                                        @{{?}}
                                    </div>
                                    <div class="weui-cell__bd">
                                        @{{=value3.name}}
                                    </div>
                                </a>
                            @{{?}}
                    @{{~}}

                <div class="share-ways">
                    <div class="like">
                        <div class="praise">
                            <span id="praise"><i class="icon ion-thumbsup"></i></span>
                            <span id="praise-txt">43</span>
                            <span id="add-num"><em>+1</em></span>
                        </div>
                    </div>
                    <div class="share-counts"><i class="icon ion-ios-upload-outline"></i><span>99</span></div>
                </div>
            </div>
        @{{~}}
    </script>
<!-- 无限加载 -->
<script src="{{ asset('vendor/jquery.endless-scroll-1.3.js') }}"></script>
<script type="text/javascript">
        var fireEvent = true;
        var working = false;
        var type=0;
        var parent_box=$('.tab-item-'+(parseInt(type)+1));
        var scroll_box=$('.tab-box-'+(parseInt(type)+1));
        var is_hot=0;
        $('.tab-list>div').on('click', function(event) {
            event.preventDefault();
            $(this).addClass('active').siblings().removeClass('active');
            var index=$(this).index();
            //是否请求热门的
            type=index;
            fireEvent=true;
            parent_box=$('.tab-item-'+(parseInt(type)+1));
            scroll_box=$('.tab-box-'+(parseInt(type)+1));
            $('.content-box>div').hide().eq(index).show();
        });

        //父节点容器
        console.log(parent_box);

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
                url: '/api/post_found/{{ $type }}',
                data:{
                    skip:parent_box.find('.scroll-item').length,
                    take:8,
                    is_hot:type
                },
                type:"GET",
                success:function(data){
                    if(data.status_code==0){
                      working = false;
                      var all_posts=data.data;
                      console.log(all_posts.length);
                      if (all_posts.length == 0) {
                        fireEvent = false;
                        console.log('没有更多了');
                        parent_box.find('#postinfo').show();
                        return;
                      }
                      var tempFn = doT.template($('#template').html());
                      var resultHTML = tempFn(all_posts);
                      console.log(resultHTML);
                      scroll_box.append(resultHTML);
                    }
                  }
              });
            }
        });
</script>
@endsection