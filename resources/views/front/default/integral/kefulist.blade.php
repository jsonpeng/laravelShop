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

@if(count($kefus))
	@foreach ($kefus as $kefu)
		<div class="kefu_item weui-cell">
			<div class="weui-cell__bd">
				<p class="name">{!! $kefu->name !!}：在线咨询时间<span>9:00-17:00</span></p>
				<p class="intr">您好！可以长按二维码加微信联系客服！或者拨打客服热线{!! getSettingValueByKeyCache('service_tel') !!}</p>
				<div class="qrcode">
					<img src="{{ $kefu->qr_code }}" alt="">
				</div>
			</div>
		</div>
	@endforeach
@endif


@endsection

@section('js')
<script type="text/javascript">

</script>
@endsection