@extends('front.default.layout.base')

@section('css')
	<style>
		.logo img{border-radius: 50%;overflow:hidden; }
		.getCode.disable{color:#ddd;border: 1px solid #ddd;}
    </style>
@endsection

@section('title')
@endsection

@section('content')
	<div class="resetPwd">
		<div class="nav_tip">
		  <div class="img">
		    <a href="javascript:history.back(-1);"><i class="icon ion-ios-arrow-left"></i></a></div>
		  <p class="titile">{!! empty($user->{'password-pay'}) ? '设置' : '修改' !!}支付密码</p>
		</div>
		<div class="logo weui-cell">
		    <img  src="{!! $user->head_image !!}" onerror="javascript:this.src='/images/trade/n1.jpg';" alt="">
		</div>
		<form >
			<div class="weui-cells weui-cells_form">
				 <div class="weui-cell">
				    <div class="weui-cell__bd">
				    	<input type="text" name="mobile" class="putPhoneNum" placeholder="手机号"><div class="getCode" data-abled="1">获取验证码</div>
				    </div>
				</div>
				 <div class="weui-cell">
				    <div class="weui-cell__bd">
				      <input type="text" name="code" placeholder="请输入验证码">
				    </div>
				 </div>
			  </div>
			

		    <div class="weui-cells weui-cells_form">
		        <div class="weui-cell">
		            <div class="weui-cell__bd">
		                <input type="password" name="password" placeholder="设置新支付密码：">
		            </div>
		        </div>
		        <div class="weui-cell">
		            <div class="weui-cell__bd">
		                <input type="password" name="enter_password" placeholder="确认支付密码：">
		            </div>
		        </div>
		    </div>

		<div class="page">
		    <div class="page__bd page__bd_spacing">
		        <button class="weui-btn weui-btn_primary enterPayPwd" type="button">确认提交</button>
		    </div>
		</div>
	</div>
@endsection


@section('js')
<script type="text/javascript" src="{{ asset('vendor/layer/layer.js') }}"></script>
<script type="text/javascript">
    //获取验证码
    $('.getCode').click(function(){
        var mobile = $('input[name=mobile]').val(); 
        if($.empty(mobile)){
          alert('请先输入手机号');
          return false;
        }
        if($(this).data('abled')){
          $.zcjyRequest('/ajax/send_code/set_pay_pwd',function(res){
              if(res){
                  time();
              }
          },{mobile:mobile});
        }
    });
    //提交
    $('.enterPayPwd').click(function(){
    	$.zcjyRequest('/ajax/set_pay_pwd',function(res){
    			if(res){
    				alert(res);
    				location.href="/usercenter";
    			}
    	},$('form').serialize());
    });

    var wait=60;
    function time() {
            var o = $('.getCode');
            if (wait == 0) {
                o.removeClass('disable');
                o.data("abled",1);   
                o.text("获取验证码");
                wait = 60;
            } 
            else { 
                o.addClass('disable');
                o.data("abled",0); 
                o.text("重新发送(" + wait + ")");
                wait--;
                setTimeout(function() {
                    time()
                }, 1000);
            }
  }
      
</script>
@endsection