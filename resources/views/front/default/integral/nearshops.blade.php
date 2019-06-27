@extends('front.default.layout.base')

@section('css')

@endsection

@section('title')
@endsection

@section('content')
	<div class="near_shops">
		<div class="nav_tip">
		  <div class="img">
		    <a href="javascript:history.back(-1)">
		        {{-- <img class="mail" id="mail" src="{{ asset('images/social/mail.png') }}"> --}}
		        <i class="icon ion-ios-arrow-left"></i>
		    </a></div>
		  <p class="titile">附近商家</p>
		</div>

		<div class="weui-cell title" style="display: none;">
			<div class="weui-cell__bd">共?个商家</div>
		</div>

		<div class="item-tem" style="display:none;">
		<a class="site weui-cell" href="" >
		    <div class="weui-cell__hd">
		        <img src="{{ asset('images/trade/locationIcon.png') }}" alt="">
		    </div>
		    <div class="weui-cell__bd">
		        <p class="companyName">企业店铺名称</p>
		        <p class="address">湖北省武汉市光谷广场资本大厦A座405室</p>
		    </div>
		    <div class="weui-cell__ft distance">1.4km</div>
		</a>
		</div>
	

	</div>
@endsection


@section('js')
<script>

var longitude='';  
var latitude='';  

        //判断是否支持 获取本地位置
        if (navigator.geolocation) {
           var n = navigator.geolocation.getCurrentPosition(function(res){
               longitude = res.coords.longitude;
               latitude = res.coords.latitude;
               console.log(longitude+','+latitude); // 需要的坐标地址就在res中
               getStores();
           },function(e){
           		console.log(e);
           });
        } 
        else {
            alert('您使用的浏览器不支持或者未开放手机定位权限,查看的商家地址将不准确');
        }

// if(navigator.geolocation) {
//     navigator.geolocation.getCurrentPosition(
//         function (position) {  
//             longitude = position.coords.longitude;  
//             latitude = position.coords.latitude;  
//             console.log(longitude)
//             console.log(latitude)
//             getStores();
//             },
//             function (e) {
//              var msg = e.code;
//              var dd = e.message;
//              console.log(msg)
//              console.log(dd)
//              if(msg){
//              	alert('您使用的浏览器不支持或者未开放手机定位权限,查看的商家地址将不准确');
//              	getStores();
//              	//location.href="/";
//              }   
//         }
//       ) 
// }

//定时器监听
var timer;
timer = setInterval(function(){
	if($.empty(longitude) && $.empty(latitude)){
		getStores();
		window.clearInterval(timer);
	}
	else{
		window.clearInterval(timer);
	}
},5000);

//获取店铺
function getStores(){
	 var tem = $('.item-tem');
	 if($('.site').length <=1){
		 $.zcjyRequest('/ajax/get_near_shops',function(res){
			if(res){
				for(var i = res.length -1 ; i>=0;i--){
					tem.find('.site').attr('href','/integral/company_shop/'+res[i]['id']);
					tem.find('.companyName').text(res[i]['name']);
					tem.find('.address').text(res[i]['address']);
					tem.find('.distance').text(res[i]['distance']+'km');
					$('.near_shops').append(tem.html());
				}
			}
		},{jindu:longitude,weidu:latitude});
	}
}


</script>
@endsection