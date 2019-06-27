@extends('front.default.layout.base')

@section('css')
<style>
	.page__bd_spacing{padding: 7.5px 0;}
	body{background-color: #fff;}
	.withdraw-sum .weui-btn{margin-top: 0;border-radius:0;}
	.withdraw-sum .withdraw-bank{border-bottom: 1px solid #d4d6dc;margin: 0;}
</style>
@endsection

@section('content')
<div class="nav_tip">
  <div class="img">
    <a href="javascript:history.back(-1)"><i class="icon ion-ios-arrow-left"></i></a></div>
  <p class="titile">客服中心</p>
</div>

<div class="kefu_item weui-cell">
	<div class="weui-cell__bd">
		<p class="name">客服1：在线咨询时间<span>9:00-17:00</span></p>
		<p class="intr">您好！可以长按二维码加微信联系客服！或者拨打客服热线400-</p>
		<div class="qrcode">
			<img src="{{ asset('images/trade/qrcode.jpg') }}" alt="">
		</div>
	</div>
</div>

<div class="kefu_item weui-cell">
	<div class="weui-cell__bd">
		<p class="name">客服1：在线咨询时间<span>9:00-17:00</span></p>
		<p class="intr">您好！可以长按二维码加微信联系客服！或者拨打客服热线400-</p>
		<div class="qrcode">
			<img src="{{ asset('images/trade/qrcode.jpg') }}" alt="">
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">

</script>
@endsection