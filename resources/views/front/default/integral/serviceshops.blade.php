@extends('front.default.layout.base')

@section('css')
<style>.weui-grid{width: 25%;}</style>
@endsection

@section('content')
<div class="nav_tip">
  <div class="img">
    <a href="/usercenter"><i class="icon ion-ios-arrow-left"></i></a></div>
  <p class="titile">服务商户</p>
{{--   <div class="userSet">
      <a href="javascript:;">
            <img src="{{ asset('images/trade/find.png') }}" alt="">
      </a>
  </div> --}}
</div>
<div class="weui-cell classify">
  商户分类
</div>
<div class="weui-cell cutLine">
  <div class="line"></div>
</div>

<div class="differentiate">
  <a class="item  @if(empty($cat)) active @endif" href="/integral/service_shops">全部</a>
  @if(count($cats))
    @foreach ($cats as $item)
       <a class="item @if(!empty($cat) && $cat->id == $item->id) active @endif" href="/integral/service_shops/{!! $item->id !!}" >{!! $item->name !!}</a>
    @endforeach
  @endif
</div>

@if(count($stores))
<?php $index=1;?>
  @foreach ($stores as $store)
      <div class="store_item" >
          <img src="{{ $store->image }}" data-url="/integral/company_shop/{!! $store->id !!}" onerror="javascript:this.src='/images/trade/s1.jpg';" alt="">
          <div class="site weui-cell">
              {{-- <div class="weui-cell__hd">{!! $index++; !!}</div> --}}
              <div class="weui-cell__bd seeMap">
                  <p class="companyName">{!! $index++; !!}  {{ $store->name }}</p>
                  <p class="address">{{ $store->address }}</p>
              </div>
              <a class="weui-cell__ft" href='tel://{{ $store->mobile }}'>拨打电话</a>
          </div>
      </div>
  @endforeach
@endif

@endsection

@section('js')
<script type="text/javascript" src="{{ asset('vendor/layer/layer.js') }}"></script>
<script type="text/javascript">
(function(){
  $('.seeMap').click(function(){
    $.zcjyFrameOpen('{!! Request::root() !!}'+'/map?address='+$(this).parent().find('.address').text(),'地图中查看:'+$(this).parent().find('.address').text());
  });
  $('.store_item > img').click(function(){
      location.href = $(this).data('url');
  });
})();
</script>
@endsection