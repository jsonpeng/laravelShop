@extends('front.default.layout.base')

@section('css')
    <style>
    	body{background-color:#fff;}
        .weui-grid{width: 25%;}
        .putPrice{display: none;}
        .putPrice.active{display: flex;}
    </style>
@endsection

@section('content')
	<div class="nav_tip">
	  <div class="img">
	    <a href="javascript:history.back(-1);"><i class="icon ion-ios-arrow-left"></i></a></div>
	  <p class="titile">充值</p>
	</div>
	
	<div class="chargeNum">
		<p class="title">选择充值金额</p>
		<div class="weui-cell sum">
			<div class="weui-cell__bd topup-select">
				<p data-price="100">¥100</p>
				<p data-price="500">¥500</p>
				<p data-price="1000">¥1000</p>
				<p data-price="2000">¥2000</p>
			</div>
		</div>
		<div class="weui-cell otherNum">
			<div class="weui-cell__bd">其他充值金额</div>
		</div>
		<div class="weui-cell putPrice" >
			<div class="weui-cell__hd">¥</div>
			<div class="weui-cell__bd">
				<input type="text" name="price">
			</div>
		</div>
		<div class="weui-cells chargeWay">
			<div class="weui-cell payType" data-pay="wechat">
				<div class="weui-cell__hd">
					<img src="{{asset('images/trade/wechatpay.png')}}" alt="">
				</div>
				<div class="weui-cell__bd">微信支付（推荐）</div>
				<div class="weui-cell__ft">
					<img  src="{{asset('images/trade/normal.png')}}" alt="">
				</div>
			</div>
	{{-- 		<div class="weui-cell">
				<div class="weui-cell__hd">
					<img src="{{asset('images/trade/friendPay.png')}}" alt="">
				</div>
				<div class="weui-cell__bd">找微信好友代付</div>
				<div class="weui-cell__ft">
					<img src="{{asset('images/trade/normal.png')}}" alt="">
				</div>
			</div>
			<div class="weui-cell">
				<div class="weui-cell__hd">
					<img src="{{asset('images/trade/qqPay.png')}}" alt="">
				</div>
				<div class="weui-cell__bd">QQ钱包</div>
				<div class="weui-cell__ft">
					<img src="{{asset('images/trade/normal.png')}}" alt="">
				</div>
			</div> --}}
			<div class="weui-cell payType" data-pay="alipay">
				<div class="weui-cell__hd">
					<img src="{{asset('images/trade/aliPay.png')}}" alt="">
				</div>
				<div class="weui-cell__bd">支付宝</div>
				<div class="weui-cell__ft">
					<img src="{{asset('images/trade/normal.png')}}" alt="">
				</div>
			</div>
		</div>

		<div class="btn_bottom">确认并付款</div>
	</div>


@endsection


@section('js')

	<script src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" src="{{ asset('js/ap.js') }}"></script>
	<script type="text/javascript" src="{{ asset('vendor/layer/layer.js') }}"></script>
	<script type="text/javascript">
		//点击选择充值金额
		$('.topup-select > p').click(function(){
			$('.putPrice').removeClass('active');
			$('.topup-select > p').removeClass('active');
			$(this).addClass('active');
		});
		//选择其他充值金额
		$('.otherNum').click(function(){
			$('.topup-select > p').removeClass('active');
			$('.putPrice').addClass('active');
		});
		//选择支付方式
		$('.payType').click(function(){
			$('.payType').removeClass('active');
			$('.payType').find('img:eq(1)').attr('src','/images/trade/normal.png');
			$(this).addClass('active');
			$(this).find('img:eq(1)').attr('src','/images/trade/click.png');
		});

		function onBridgeReady(message) {
			    var data = JSON.parse(message);
			    /* global WeixinJSBridge:true */
			    WeixinJSBridge.invoke(
			      'getBrandWCPayRequest', {
			        'appId': data.appId, // 公众号名称，由商户传入
			        'timeStamp': data.timeStamp, // 时间戳，自1970年以来的秒数
			        'nonceStr': data.nonceStr, // 随机串
			        'package': data.package,
			        'signType': data.signType, // 微信签名方式：
			        'paySign': data.paySign // 微信签名
			      },
			      function (res) {
			      	// alert(JSON.stringify(res));
			        // 使用以上方式判断前端返回,微信团队郑重提示：res.err_msg将在用户支付成功后返回ok，但并不保证它绝对可靠。
			        if (res.err_msg === 'get_brand_wcpay_request:ok') {
			            // var $toast = $('#toast');
			            // $('#toast-info').text('支付成功');
			            // $toast.fadeIn(100);
			            setTimeout(function () {
			                //$toast.fadeOut();
			                window.location.href = '/usercenter';
			            }, 1000);
			            
			        } else {
			        	alert('支付失败');
			        }
			      }
			    );
  		}

		//确定支付
		$('.btn_bottom').click(function(){
			var price = '';
			$('.topup-select > p').each(function(){
				if($(this).hasClass('active')){
					price = $(this).data('price');
				}
			});
			if($('.putPrice').hasClass('active')){
				price = $('input[name=price]').val();
			}
			if(price == ''){
				alert('请输入充值金额!');
				return false;
			}
			if(!$('.payType').hasClass('active')){
				alert('请选择支付方式!');
				return false;
			}
			var type = $('.payType.active').data('pay');
			console.log(type);
			$.zcjyRequest('/ajax/user_money/topup',function(res){
				console.log(res);
				if(type == 'wechat'){
				   	if (typeof WeixinJSBridge === 'undefined') { // 微信浏览器内置对象。参考微信官方文档
		                if (document.addEventListener) {
		                  document.addEventListener('WeixinJSBridgeReady', onBridgeReady(res), false)
		                } 
		                else if (document.attachEvent) {
		                  document.attachEvent('WeixinJSBridgeReady', onBridgeReady(res));
		                  document.attachEvent('onWeixinJSBridgeReady', onBridgeReady(res));
		                }
		            } 
		              else {
		                onBridgeReady(res);
		              }
				}
				else if(type == 'alipay'){
					 console.log(res);
					 if(res){
					 	_AP.pay(res);
					 }
					 //
				}
			},{price:price,type:type});
		});
	</script>
@endsection