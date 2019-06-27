@extends('front.default.layout.base')

@section('css')
<style>.weui-grid{width: 25%;}</style>
@endsection

@section('content')
	<div class="myeval">
		<div class="nav_tip">
		  <div class="img">
		    <a href="javascript:history.back(-1)"><i class="icon ion-ios-arrow-left"></i></div></a>
		  <p class="titile">我的评价</p>
		</div>
		@if(count($evals))
			@foreach ($evals as $item)
				<div class="evaluateItem">
				    <div class="weui-cell object">
				        <div class="weui-cell__hd">
				          <img  onerror="javascript:this.src='/images/trade/n1.jpg';" src="{!! $item['product']->image !!}" alt="">
				        </div>
				        <div class="weui-cell__bd">
				            <p class="userName">{!! $item['product']->name !!} @if(!empty($item['spec'])) [{!! $spec->key_name !!}] @endif </p>
				            <img src="/images/trade/s{!! $item->all_level !!}.png" alt="">
				        </div>
				        <div class="weui-cell__ft delete" data-id="{!! $item->id !!}"><img src="{{ asset('images/trade/delete.png') }}" alt=""></div>
				    </div>
				    <div class="evaluateTxt">
				      {!! $item->content !!}
				    </div>
				    @if(count($item['attach']))
				    <div class="weui-grids">
				    	  @foreach ($item['attach'] as $attach)
						      <a href="javascript:;" class="weui-grid js_grid">
						          <img src="{!! $attach->url !!}" alt="">
						      </a>
						 @endforeach
				    </div>
				    @endif

				    <div class="weui-cell MerchantServices">
				    	<div class="weui-cell__hd">商家服务：</div>
				    	<div class="weui-cell__bd">
				    		<img src="/images/trade/{!! $item->service_level !!}.png" alt="">
				    	</div>
				    </div>
				    <div class="weui-cell logistics">
				    	<div class="weui-cell__hd">物流速度：</div>
				    	<div class="weui-cell__bd">
				    		<img src="/images/trade/{!! $item->logistics_level !!}.png" alt="">
				    	</div>
				    </div>
				    <div class="weui-cell entirety">
				    	<div class="weui-cell__hd">整体评价：</div>
				    	<div class="weui-cell__bd">
				    		<img src="/images/trade/{!! $item->overall_level !!}.png" alt="">
				    	</div>
				    </div>
				    <div class="evaluateLikes"><span>{!! $item->zan !!}</span><img src="{{ asset('images/trade/likes.png') }}" alt="">
				    </div>
				</div>
			@endforeach
		@endif
	</div>
@endsection

@section('js')
<script type="text/javascript">
	$('.delete').click(function(){
		var that = this;
		$.zcjyRequest('/ajax/product_eval/delete/'+$(this).data('id'),function(res){
			if(res){
				$(that).parent().parent().remove();
			}
		});
	});
</script>
@endsection