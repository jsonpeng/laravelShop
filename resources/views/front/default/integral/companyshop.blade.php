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
        <img  src="{!! $store->image !!}" onerror="javascript:this.src='/images/trade/show1.jpg';" alt="">
    </div>

    <div class="site weui-cell">
        <div class="weui-cell__hd">
            <img src="{{ asset('images/trade/blue.png') }}" alt="">
        </div>
        <div class="weui-cell__bd">
            <p class="companyName">{!! $store->name !!}</p>
            <p class="address">{!! $store->address !!}</p>
        </div>
        <div class="weui-cell__ft seeMap">查看地图</div>
    </div>
    
    @if(count($products))
        <div class="product-wrapper scroll-container"  id="product-box">
            @foreach ($products as $item)
                <a class="product-item2 scroll-post" href="/product/{!! $item->id !!}">
                    <div class="img">
                        <img class="lazy" data-original="{{ $item->image }}">
                    </div> 
                    <div class="title">{!! $item->name !!}</div>
                        <div class="price">¥{!! $item->price !!}<b>+ </b>HB{!! $item->jifen !!}{!! getSettingValueByKeyCache('credits_alias') !!}<span>已售 {!! $item->sales_count !!}</span></div>
                </a>
             @endforeach
        </div>
    @endif

@endsection


@section('js')
<script type="text/javascript" src="{{ asset('vendor/layer/layer.js') }}"></script>
<script type="text/javascript">
(function(){
  $('.seeMap').click(function(){
    $.zcjyFrameOpen('{!! Request::root() !!}'+'/map?address='+$(this).parent().find('.address').text(),'地图中查看:'+$(this).parent().find('.address').text());
  });
})();
</script>
@endsection