<?php

use Illuminate\Support\Facades\Config;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//前端中间件配置
$mid = ['web', 'wechat.oauth:snsapi_userinfo', 'auth.user'];
if (Config::get('web.app_env') == 'local'){
	$mid = ['web', 'auth.user'];
}

//用于小程序的webview
Route::group([ 'prefix' => 'webview'], function () {
	//单页面
	Route::get('/page/{slug}','Front\PostController@page');
	//通知消息
	Route::get('/notices/{id}','Front\IndexController@notice');
	//物流查询
	Route::get('/logistics','Front\IndexController@logistics');
});

// Route::get('test_sql',function(){
// 	dd(bubbleSort(['1','5','3','4']));
// });

#图片地址转base64
Route::get('image_base64','AppBaseController@delImageSrc');

#支付宝同步跳转
Route::get('alipay_return','Front\AjaxController@alipayWebReturn');
#支付宝异步通知
Route::get('alipay_notify','Front\AjaxController@alipayWebNotify');

//通知消息
Route::get('/notices/{id}','Front\IndexController@notice');

//微信支付
Route::any('/notify_wechcat_pay', 'Front\PayController@payWechatNotify');
//PAYS_API支付
// Route::get('/pays_api/{order_id}', 'Front\PayController@paysApi');
// Route::any('/paysapi_return', 'Front\PayController@paysapiReturn');
// Route::any('/paysapi_notify', 'Front\PayController@paysapiNotify');

Route::any('/wechat', 'Admin\Wechat\WechatController@serve');

Route::group(['middleware' => ['api']], function () {
	//发送短信验证码
	Route::get('/sendCode', 'Front\UserController@sendCode');
});



Route::group(['middleware' => $mid, 'namespace' => 'Front'], function () {

	//微信公众号支付
	Route::get('/pay_weixin/{order_id}','PayController@payWechat');

	//ajax接口请求
	Route::group(['prefix'=>'ajax'],function(){
		#查询用户订单
		Route::get('query_orders','AjaxController@queryOrders');
		#发送不同类型的验证码
		Route::get('send_code/{type?}','AjaxController@sendMobileCode');
		#购物车数量
		Route::get('shop_cart_num','AjaxController@shopCartNum');
		#删除通知消息
		Route::get('message/delete','AjaxController@deleteMessage');
		#发起实名认证
		Route::get('certs/publish','AjaxController@certsPublish');
		#上传图片
		Route::post('uploads','AjaxController@uploads');
		#发起商品评价
		Route::get('product_eval/publish','AjaxController@evalPublish');
		#删除评价
		Route::get('product_eval/delete/{eval_id}','AjaxController@evalDelete');
		#点赞评价
		Route::get('product_eval_zan/{eval_id}','AjaxController@evalZan');
		#提交客服反馈
		Route::get('submit_feedback','AjaxController@submitFeedBack');
		#获取附近的商户
		Route::get('get_near_shops','AjaxController@getNearStores');
		#更新信息
		Route::get('update_info','AjaxController@updateUserInfo');
		#需要实名认证才能用
		Route::group(['middleware'=>'zcjy_web_cert'],function(){
			#充值消耗货呗卡huobeiTopup
			Route::get('credits/topup','AjaxController@huobeiTopup');
			#转赠货呗
			Route::get('credits/send','AjaxController@huobeiSend');
			#发起余额充值
			Route::get('user_money/topup','AjaxController@userYueTopup');
			#发起余额提现
			Route::get('user_money/withdrawal','AjaxController@userYueWithdrawl');
			#设置支付密码
			Route::get('set_pay_pwd','AjaxController@setPayPwd');
		});
	});

	//商城首页
	Route::get('/', 'IndexController@index');

	//联系客服
	Route::get('/kefu','UserController@contactKefu');
	
	//账户功能
	Route::get('/mobile','UserController@mobile');
	Route::post('/mobile','UserController@postMobile');
	Route::get('/reset_password','UserController@resetPassword');

	//文章分类
	Route::get('/post_cat/{cat_id?}','PostController@postCats');
	//文章列表
	Route::get('/posts/{cat_id?}','PostController@posts');
	//文章详情
	Route::get('/post/{id}','PostController@postDetail');
	//页面
	Route::get('/page/{slug}','PostController@page');

	//账号需注册手机号
	Route::group(['middleware' => 'mobile'], function () {
		
		//分类页面
		Route::get('/category','CategoryController@index');
		Route::get('/category/level1/{id}','CategoryController@level1')->name('front.mobile.catlevel1');
		Route::get('/ajax/category/level1/{id}','CategoryController@ajaxLevel1');
		Route::get('/category/level2/{id}','CategoryController@level2')->name('front.mobile.catlevel2');
		Route::get('/category/level3/{id}','CategoryController@level2')->name('front.mobile.catlevel3');
		Route::get('/category/cat_level_01/{cat_id?}','CategoryController@catLevel01');

		//品牌街
		Route::get('/brands','BrandController@index');
		Route::get('/brand/{brand_id}','BrandController@productList')->name('front.mobile.brand');

		//商品详情页面
		Route::get('/product/{id}','ProductController@index')->name('front.mobile.product');
		//产品列表
		Route::get('/product_of_type/{type}','ProductController@productOfType');
		Route::get('/ajax/products_of_type/{type}','ProductController@ajaxProductOfType');
		Route::get('/ajax/product_search','ProductController@ajaxProductSearch');

		//用户中心
		Route::get('/usercenter','UserController@index');
		//团购管理
		Route::get('/usercenter/team','UserController@teamList');

	    //收藏列表
	    Route::get('/usercenter/collections','UserController@collections');
	    Route::get('/ajax/collections','UserController@ajaxCollections');
	    //添加或取消收藏
	    Route::post('/ajax/collect_or_cancel/{product_id}','UserController@collectOrCancel');

		//银行卡管理
		Route::get('/usercenter/bankcards','BankCardController@index');
	    Route::get('/usercenter/bankcards/add','BankCardController@add');
        Route::get('/usercenter/bankcards/edit/{bank_id}','BankCardController@edit');
        //银行卡列表选择
        Route::get('/usercenter/bankcards/list','BankCardController@bankListToChoose');
        //bankListToChoose
        //banklist
		Route::get('/usercenter/credits','CreditController@index');
		Route::get('/ajax/credits','CreditController@ajaxCredits');
		//余额
        Route::get('/usercenter/blances','UserController@userBalancePage');
        Route::get('/ajax/blances','UserController@ajaxUserBalance');
        //提现列表
        Route::get('/usercenter/withdrawal','UserController@userWithDrawalPageList');
        //提现操作
        Route::get('/usercenter/withdrawal/action','UserController@userWithDrawalPageAction');

		//推荐人列表
		Route::get('/usercenter/fellow','UserController@followMembers');
		Route::get('/ajax/fellow','UserController@ajaxFollowMembers');

		//分佣记录
		Route::get('/usercenter/bonus','UserController@bonusList');
		Route::get('/ajax/bonus','UserController@ajaxBonusList');
		Route::get('/usercenter/qrcode','UserController@shareCode');

		//购物车API
		Route::get('/api/cart/add','CartController@add');
		Route::get('/api/cart/update','CartController@update');
		Route::get('/api/cart/delete','CartController@delete');
		Route::get('/ajax/coupons','CouponController@ajaxCoupons');
		Route::get('/api/coupon_choose/{coupon_id}','CouponController@getCouponChoose');
		Route::get('/api/cart_num','CartController@getCartNum');

		//再次购买
		Route::get('/buy_again/order/{id}','CartController@buyAgain');
		//购物车页面
		Route::get('/cart','CartController@cart');
		//结算页面
		Route::get('/check','CartController@check');
		Route::post('/check','CartController@postCheck');

		//邮件通知新订单
        Route::post('/mailInform/{order_id}','IndexController@mailInform');

		Route::get('/checknow','CartController@checkNow');
		Route::post('/checknow','CartController@postCheckNow');
		//订单管理
		
		Route::get('/orders/{type?}','OrderController@index');
		Route::get('/ajax/orders','OrderController@orders');
		Route::get('/order/{id}','OrderController@detail');
		Route::get('/cancel/order/{id}','OrderController@cancel');

		Route::get('/delete/order/{id}','OrderController@delete');
		Route::get('/confirm/order/{id}','OrderController@confirm');

		//退换货
		Route::get('/refunds','OrderController@refundList');
		Route::get('/refund/{item_id}','OrderController@refund');
		Route::post('/postRefund/{item_id}','OrderController@postRefund');
		Route::get('/refundStatus/{id}','OrderController@refundStatus');
		Route::get('/canRefund/{id}','OrderController@canRefund');
		Route::get('/refund/changeDelivery/{id}','OrderController@refundChangeDelivery');
		Route::get('/refund/cancel/{id}','OrderController@refundCancel');

		//优惠券
		Route::get('/coupon/{type?}','CouponController@index');
		Route::get('/ajax/coupons/{type?}','CouponController@ajaxCoupon');

		//地址管理
		//个人中心地址管理首页
		Route::get('/address','AddressController@index');
		//结算页面，收货地址列表
		Route::get('/address/change','AddressController@change');
		//用户选择收货地址
		Route::get('/address/select/{id}','AddressController@select');
		//用户设置默认收货地址
		Route::get('/address/default/{id}/{default}','AddressController@default');
		//添加地址页面
		Route::get('/address/add','AddressController@create');
		//保存地址
		Route::post('/address/add','AddressController@store');
		//编辑地址
		Route::get('/address/edit/{id}','AddressController@edit');
		//更新地址
		Route::post('/address/update/{id}','AddressController@update');
		//删除地址
		Route::get('/address/delete/{id}','AddressController@delete');
		//获取城市信息
		Route::post('/api/cities/getAjaxSelect/{id}','AddressController@CitiesAjaxSelect');

		//活动促销
		Route::get('/product_promp','ProductPrompController@index');
		Route::get('/product_promp/{id}','ProductPrompController@list');

		//团购
		Route::get('/group_sale','ProductGroupController@index');
		//秒杀
		Route::get('/flash_sale','FlashSaleController@index');
		//拼团
		Route::get('/team_sale','TeamSaleController@index');
		Route::get('/team_share/{found_id}','TeamSaleController@share');

	    
	    //银行卡信息列表
	    Route::post('/api/ajax_get_bank_info','BankCardController@ajax_get_bank_info');
	    //保存银行卡信息
	    Route::post('/api/bank_info/save','BankCardController@save_bank_info');
	    //删除银行卡信息
	    Route::post('/api/bank_info/{id}/del','BankCardController@del_bank_info');

        //领取优惠券
        Route::post('/api/userGetCoupons/{coupons_id}','IndexController@userGetCoupons');
        //用户发起提现
        Route::post('/api/withdraw_account','UserController@withdraw_account');

  //       //单页面
  //       
		// //文章分类
		// Route::get('/cat/{id}','ArticleAndPageController@cat');
		// //文章内页
		// Route::get('/post/{id}','ArticleAndPageController@post');
		// //页面内页
		// Route::get('/page/{id}','ArticleAndPageController@page');

		// 主题social  新增页面
		//Route::get('/index_2', 'IndexController2@index_2');
		Route::get('/found/{type?}','FoundController@index');
		
		#充值余额
		Route::get('/topup','IndexController@userMoneyTopup');

		//积分收藏
		Route::get('/usercenter/mycollections','UserController@myCollections');
		
		//积分新主题
		Route::group(['prefix'=>'integral'],function(){
				#修改电话
				Route::get('edit_mobile','IndexController@editMobile');
				#修改密码
				Route::get('edit_password','IndexController@editPwd');
				#发布评价
				Route::get('publish_eva','IndexController@publishEva');
				#附近商家
				Route::get('near_shops','IndexController@nearShops');
				#通知消息
				Route::get('message','IndexController@messages');
				#服务商户
				Route::get('service_shops/{id?}','IndexController@serviceShops');
				#企业店铺
				Route::get('company_shop/{id}','IndexController@companyShop');
				#呗壳转赠
				Route::get('giving','IndexController@giving');
				#实名认证
				Route::get('cert','IndexController@cert');
				#实名认证提交成功/已认证
				Route::get('cert_success','IndexController@certSuccess');
				#我的评价
				Route::get('myeval','IndexController@myeval');
				#我的钱包
				Route::get('mywallet','IndexController@mywallet');
				#客服列表
				Route::get('kefulist','IndexController@kefulist');
				#客服反馈
				Route::get('kefufeedback','IndexController@kefuFeedBack');
				
				#充值货呗
				Route::group(['prefix'=>'credits'],function(){
					Route::get('topup','IndexController@creditsTopup');
				});
				#设置
				Route::get('setting','IndexController@meSetting');
				#设置支付密码
				Route::get('set_pay_pwd','IndexController@setPayPassword');
				#设置昵称
				Route::get('set_nickname','IndexController@setNickname');
				#设置手机号
				Route::get('set_mobile','IndexController@setMobile');
				#设置性别
				Route::get('set_sex','IndexController@setSex');
		});
	});
	//退换货上传图片
	Route::post('/api/refundUploadImage/{refunds_id}','Admin\OrderRefundController@refundUploadImage');
	//退换货切换图片
	Route::post('/api/switchRefundUploadImage/{or_id}','Admin\OrderRefundController@switchRefundUploadImage');
});






// Route::resource('projectImages', 'ProjectImageController');







// Route::resource('productEvals', 'ProductEvalController');

// Route::resource('attachEvals', 'AttachEvalsController');



// Route::resource('adminShops', 'AdminShopController');