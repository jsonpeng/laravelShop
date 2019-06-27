@extends('front.default.layout.base')

@section('css')
    <style>
		
    </style>
@endsection

@section('content')
<div class="nav_tip">
  <div class="img">
    <a href="/usercenter"><i class="icon ion-ios-arrow-left"></i></a></div>
  <p class="titile">我的钱包</p>
</div>
<div class="wallet">
	<div class="bg">
		<img src="{{asset('images/trade/wallet.jpg')}}" alt="">
	</div>
	<div class="selfInfo weui-cell">
		<div class="weui-cell__bd">
			<div class="Uimg">
				<img  src="{!! $user->head_image !!}" onerror="javascript:this.src='/images/trade/n1.jpg';" alt="">
			</div>
			<p class="name">{!! $user->nickname !!}</p>
			<div class="balance"><p>{!! getSettingValueByKeyCache('credits_alias') !!}：<span>{!! $user->credits !!}</span></p><p>余额：<span>{!! $user->user_money !!}</span></p></div>
		</div>
	</div>

	<div class="function weui-cells">
		<a class="weui-cell" href="/topup">
			<div class="weui-cell__bd"><img src="{{asset('images/trade/rmb.png')}}" alt="">余额充值</div>
		</a>
		<a class="weui-cell" href="/integral/credits/topup">
			<div class="weui-cell__bd"><img src="{{asset('images/trade/money.png')}}" alt="">{!! getSettingValueByKeyCache('credits_alias') !!}充值</div>
		</a>
		<a class="weui-cell" href="/usercenter/withdrawal/action">
			<div class="weui-cell__bd"><img src="{{asset('images/trade/right.png')}}" alt="">余额提现</div>
		</a>
		<a class="weui-cell" href="/integral/giving">
			<div class="weui-cell__bd"><img src="{{ asset('images/trade/c5.jpg') }}" alt="">{{ getSettingValueByKeyCache('credits_alias') }}转赠</div>
		</a>
	</div>

	<div class="weui-tab">
		<div class="weui-navbar">
			<a class="weui-navbar__item weui-bar__item_on" href="javascript:;">
			    <span>余额变动记录</span>
			</a>
		    <a class="weui-navbar__item" href="javascript:;">
		        <span>{!! getSettingValueByKeyCache('credits_alias') !!}变动记录</span>
		    </a>
		</div>
	    <div class="weui-tab__panel " id="scroll-container">

			@if(count($moneyLogs))
	      		@foreach ($moneyLogs as $item)
					<div class="weui-cell logItem item0">
						<div class="weui-cell__hd">
							<p class="week">{!! $item->week !!}</p>
							<p class="date">{!! $item->created_at->format('m-d') !!}</p>
						</div>
						<div class="weui-cell__bd">
							<img src="{{asset('images/trade/ok.png')}}" alt="">
							<div class="statistics">
								<p class="num">{!! $item->change !!}</p>
								<p class="source">{!! $item->detail !!}</p>
							</div>
						</div>
					</div>
				@endforeach
			@endif

			 @if(count($creditLogs))
	      		@foreach ($creditLogs as $item)
					<div class="weui-cell logItem item1" style="display: none;">
						<div class="weui-cell__hd">
							<p class="week">{!! $item->week !!}</p>
							<p class="date">{!! $item->created_at->format('m-d') !!}</p>
						</div>
						<div class="weui-cell__bd">
							<img src="{{asset('images/trade/ok.png')}}" alt="">
							<div class="statistics">
								<p class="num">{!! $item->change !!}</p>
								<p class="source">{!! $item->detail !!}</p>
							</div>
						</div>
					</div>
				@endforeach
			@endif

	    </div>

	    

	  

	  
	    {{-- creditLogs --}}
	</div>
</div>

@endsection


@section('js')
    <script src="{{ asset('vendor/doT.min.js') }}"></script>

    <script type="text/template" id="template">

    </script>

    <script type="text/javascript">
    	$('.weui-navbar__item').click(function(){
    			console.log($(this).index());
    			$('.weui-navbar__item').removeClass('weui-bar__item_on');
    			$(this).addClass('weui-bar__item_on');
    			$('.logItem').hide();
    			$('.item'+$(this).index()).show();
    	});
       
    </script>
@endsection