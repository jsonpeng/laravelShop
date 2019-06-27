@extends('front.default.layout.base')

@section('css')
	<style>
		body{background-color:#fff;}
	</style>
@endsection

@section('content')
	<div class="nav_tip">
	  <div class="img">
	    <a href="javascript:history.back(-1)"><i class="icon ion-ios-arrow-left"></i></a></div>
	  <p class="titile">余额提现</p>
	</div>


	<div class="logo weui-cell">
	    <img src="{{ asset('images/trade/time.png') }}" alt="">
	</div>
	<form >
		<div class="weui-cell cashNum">
			<div class="weui-cell__bd">
				<input type="text" name="price" placeholder="请填写提现金额" />
			</div>
		</div>

		@if($user->user_money)
		<div class="weui-cell allCash">
			<div class="weui-cell__bd">可用余额：{!! $user->user_money !!}</div>
			<div class="weui-cell__ft withdraw-all" data-max="{!! $user->user_money !!}">全部提现</div>
		</div>
		@endif

		<div class="weui-cell cashNum">
			<div class="weui-cell__bd">
				<input type="password" name="password" placeholder="请输入支付密码">
			</div>
		</div>

		<input type="hidden" name="type" value="" />

	<div class="weui-cells weui-cells_form">
		<div class="weui-cell title">
			<div class="weui-cell__bd">请选择提现渠道：</div>
		</div>
		<div class="weui-cell toWhere">
			<div class="weui-cell__bd">
				<div class="item" data-type="wechat">
					<div class="bankPic">
						<img src="{{asset('images/trade/wechatpay.png')}}" alt="">
					</div>
		
					<p>微信钱包</p>
					<div class="ifCheck">
						<img  src="{{asset('images/trade/normal.png')}}" alt="">
					</div>
					
				</div>
				<div class="item" data-type="alipay">
					<div class="bankPic">
						<img src="{{asset('images/trade/aliPay.png')}}" alt="">
					</div>
					<p>支付宝</p>
					<div class="ifCheck">
						<img  src="{{asset('images/trade/normal.png')}}" alt="">
					</div>
				</div>
			{{-- 	<div class="item">
					<div class="bankPic">
						<img src="{{asset('images/trade/qqPay.png')}}" alt="">
					</div>	
					<p>QQ钱包</p>
					<div class="ifCheck">
						<img  src="{{asset('images/trade/normal.png')}}" alt="">
					</div>
				</div> --}}
			</div>
		</div>	

	    <div class="weui-cell">
	        <div class="weui-cell__bd">
	            <p class="tip">{{ getSettingValueByKey('withdraw_bili_info') }}</p>
	        </div>
	    </div>
	</div>
	<div class="page">
	    <div class="page__bd page__bd_spacing">
	        <button class="weui-btn weui-btn_primary withdrawNow" type="button">立即提现</button>
	    </div>
	</div>
	</form>


<div id="all_bank_list" style="display: none;">
<div class="withdraw-sum weui-cells">

	@foreach($bank_list as $item)
	<div class="weui-cell  withdraw-bank withdraw-bank-list" onclick="chooseOne(this)"  data-id="{!! $item->id !!}">
		<div class="weui-cell__hd ">
			<img src="{{ getBankImgByName($item->name) }}" alt="">
		</div>
		<div class="weui-cell__bd">
			<p class="ft-l">{!! $item->name !!}</p>
			<p class="ft-s">{!! $item->subcardno !!} {!! $item->cardType !!}</p>
		</div>
		<div class="weui-cell__ft">
			<i class="weui-icon-success-no-circle" style="display: none"></i>
		</div>
	</div>
	@endforeach

	<div class="page__bd page__bd_spacing">
		<a href="/usercenter/bankcards/add" class="weui-btn">+添加新卡片</a>
	</div>
</div>
</div>
@endsection


@section('js')
<script type="text/javascript" src="{{ asset('vendor/layer/layer.js') }}"></script>
<script type="text/javascript">
	$(function(){
			var type=''; 
			$('.item').click(function(){
					type = $(this).data('type') , $('input[name=type]').val(type);
					$('.item').find('img:eq(1)').attr('src','/images/trade/normal.png');
					$(this).find('img:eq(1)').attr('src','/images/trade/click.png');
			});
			$('.withdraw-all').click(function(){
				$('input[name=price]').val($(this).data('max'));
			});
			$('.withdrawNow').click(function(){
				if($.empty(type)){
					alert('请选择提现渠道');
					return false;
				}
				$.zcjyRequest('/ajax/user_money/withdrawal',function(res){
					if(res){
						alert(res);
						location.href="/usercenter";
					}
				},$('form').serialize());
			});
	});
</script>  
@endsection