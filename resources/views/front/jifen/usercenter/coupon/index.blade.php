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
				<img src="{{asset('images/trade/n1.jpg')}}" alt="">
			</div>
			<p class="name">用户名</p>
			<div class="balance"><p>余额：<span>00</span></p><p>贝壳：<span>00</span></p></div>
		</div>
	</div>

	<div class="function weui-cells">
		<a class="weui-cell" href="/usercenter/credits">
			<div class="weui-cell__bd"><img src="{{asset('images/trade/rmb.png')}}" alt="">余额充值</div>
		</a>
		<a class="weui-cell" href="/usercenter/team">
			<div class="weui-cell__bd"><img src="{{asset('images/trade/money.png')}}" alt="">贷呗充值</div>
		</a>
		<a class="weui-cell" href="/usercenter/withdrawal/action">
			<div class="weui-cell__bd"><img src="{{asset('images/trade/right.png')}}" alt="">余额提现</div>
		</a>
	</div>

	<div class="weui-tab">
		<div class="weui-navbar">
		    <a class="weui-navbar__item  @if($type == -1) weui-bar__item_on @endif" href="/coupon">
		        <span>余额变动记录</span>
		    </a>
		    <a class="weui-navbar__item  @if($type == 0) weui-bar__item_on @endif" href="/coupon/0">
		        <span>呗壳变动记录</span>
		    </a>
		</div>
	    <div class="weui-tab__panel " id="scroll-container">
			<div class="weui-cell">
				<div class="weui-cell__hd">
					<p class="week">周一</p>
					<p class="date">11-11</p>
				</div>
				<div class="weui-cell__bd">
					<img src="{{asset('images/trade/ok.png')}}" alt="">
					<div class="statistics">
						<p class="num">-88</p>
						<p class="source">充值</p>
					</div>
				</div>
			</div>

			<div class="weui-cell">
				<div class="weui-cell__hd">
					<p class="week">周日</p>
					<p class="date">11-11</p>
				</div>
				<div class="weui-cell__bd">
					<img src="{{asset('images/trade/recharge.png')}}" alt="">
					<div class="statistics">
						<p class="num">+500</p>
						<p class="source">充值</p>
					</div>
				</div>
			</div>
	    </div>
	</div>
</div>

@endsection


@section('js')
    <script src="{{ asset('vendor/doT.min.js') }}"></script>

    <script type="text/template" id="template">
        @{{~it:value:index}}
        	<div class="weui_planel_item scroll-post @{{? value.status != 0 }} lose-effic uesed @{{?}}">

				@{{? value.status == 4 }}
					<div class="slide-toggle">
						<img  src="{{asset('images/cancel.png')}}" alt="">
					</div>
				@{{?}}
				@{{? value.status == 3 }}
					<div class="slide-toggle">
						<img  src="{{asset('images/guoqi.png')}}" alt="">
					</div>
				@{{?}}
				@{{? value.status == 2 }}
					<div class="slide-toggle">
						<img  src="{{asset('images/used.png')}}" alt="">
					</div>
				@{{?}}
				@{{? value.status == 1 }}
					<div class="slide-toggle">
						<img  src="{{asset('images/freeze.png')}}" alt="">
					</div>
				@{{?}}

				<div class="weui-panel_bd">
					<a href="javascript:;" class="weui-media-box weui-media-box_appmsg" style="align-items:flex-start;">
						@{{? value['coupon'].type == '打折' }}
						<div class="weui-media-box_hd">
							<div class="type">折扣券</div>
							<div class="sum"><span>@{{=value['coupon'].discount}}</span>折</div>
						</div>
						@{{?}}

						@{{? value['coupon'].type == '满减' }}
						<div class="weui-media-box_hd">
							<div class="type">满减券</div>
							<div class="sum"><span>@{{=value['coupon'].given}}</span>元</div>
						</div>
						@{{?}}

						<div class="weui-media-box_bd">
							<h4 class="weui-media-box_title">@{{=value['coupon'].name}}</h4>
							<p class="weui-media-box_desc">满@{{=value['coupon'].base}}可用，@{{? value['coupon'].range == 0 }} 全场通用@{{?}} @{{? value['coupon'].range == 1 }}指定分类@{{?}} @{{? value['coupon'].range == 2 }}指定商品 @{{?}}</p>
							<p class="weui-media-box_desc">有效期：@{{=value.time_begin}} - @{{=value.time_end}}</p>
						</div>
					</a>
				</div>

				@{{? value.status == 0 }}
				<div class="weui-media-box cut_line">
					<div class="border"></div>
					<div class="weui-cell-fl"></div>
					<div class="weui-cell-fr"></div>
				</div>
				<div class="weui-media-box link">
					<a href="/use_coupon/@{{=value['coupon'].id}}">立即使用</a>
				</div>
				@{{?}}

			</div>
        @{{~}}
    </script>

    <script type="text/javascript">

        $(document).ready(function(){
            //无限加载
            var fireEvent = true;
            var working = false;

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
                    url:"/ajax/coupons/{{ $type }}?skip=" + $('.scroll-post').length + "&take=18",
                    type:"GET",
                    success:function(data){
                      if (data.status_code != 0) {
                        return;
                      }

                      var coupons=data.data;

                      if (coupons.length == 0) {
                        fireEvent = false;
                        $('#scroll-container').append("<div id='loading-tips' style='padding: 15px; color: #999; font-size: 14px; text-align: center;'>别再扯了，已经没有了</div>");
                        return;
                      }
                      if (data.data.length) {
                      // 编译模板函数
                      var tempFn = doT.template( $('#template').html() );

                      // 使用模板函数生成HTML文本
                      var resultHTML = tempFn(data.data);

                      // 否则，直接替换list中的内容
                      $('#scroll-container').append(resultHTML);
                    } else {
                      
                    }
                    working = false;
                    }
                  });
                }
            });
        });
    </script>
@endsection