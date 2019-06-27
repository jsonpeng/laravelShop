<?php

$api = app('Dingo\Api\Routing\Router');



$api->version('v1', function ($api) {
	//小程序
	$api->group(['prefix' => 'mini_program'], function ($api) {
		//用户登录
		$api->get('login', 'App\Http\Controllers\API\UserController@loginMiniprogram');

		$api->get('setRelationship', 'App\Http\Controllers\API\UserController@SetRelationship');

		/**
		 * 小程序推广二维码
		 */
		$api->group(['middleware' => 'api.auth'], function ($api) {
			$api->get('distribution_code', 'App\Http\Controllers\API\UserController@distributionCode');
			$api->get('product_code', 'App\Http\Controllers\API\UserController@distributionCodeOfProduct');
		});

	});
	

	#导航信息
	$api->get('banners/{slug}', 'App\Http\Controllers\API\BannerController@banners');
	/**
	 * 产品信息获取
	 */
	# 全部产品
	$api->get('products', 'App\Http\Controllers\API\ProductController@products');

	##一级分类
	$api->get('cats_root','App\Http\Controllers\API\CategoryController@allCatsRoot');

	#分类产品(分类及子分类)
	$api->get('products_of_cat_with_children/{cat_id}', 'App\Http\Controllers\API\ProductController@productsOfCatWithChildren');

	#分类产品(当前分类不含子分类)
	$api->get('products_of_cat/{cat_id}', 'App\Http\Controllers\API\ProductController@productsOfCat');

	##品牌街 @brandsList
	$api->get('brands', 'App\Http\Controllers\API\ProductController@brandsList');

	##品牌商品 @productListByBrandId
	$api->get('brand/{brand_id}', 'App\Http\Controllers\API\ProductController@productListByBrandId');

	#新品推荐
	$api->get('new_products', 'App\Http\Controllers\API\ProductController@newProducts');

	#拼团产品
	$api->get('team_sales', 'App\Http\Controllers\API\TeamSaleController@teamSaleProducts');

	#秒杀商品
	$api->get('flash_sales', 'App\Http\Controllers\API\ProductController@flashSaleProducts');

	##热销商品
	$api->get('sales_count_products','App\Http\Controllers\API\ProductController@salesCountProducts');

	##国家馆商品
	$api->get('country_products/{country_id}','App\Http\Controllers\API\ProductController@countryProducts');

	##正在进行的活动
	$api->get('product_proms','App\Http\Controllers\API\ProductController@productPromps');
	
	##活动详情
	$api->get('product_proms/{id}','App\Http\Controllers\API\ProductController@productPrompsDetail');

	#产品详情
	$api->get('product/{id}', 'App\Http\Controllers\API\ProductController@product');

	#猜你喜欢的产品
	$api->get('fav_product/{id}', 'App\Http\Controllers\API\ProductController@favProduct');

	#获取一，二级分类
	$api->get('cats_top2_level', 'App\Http\Controllers\API\CategoryController@topTwoLevelCategories');

	#获取推荐分类
	$api->get('cats_of_recommend', 'App\Http\Controllers\API\CategoryController@catsOfRecommend');

	#获取子分类
	$api->get('children_of_cat/{cat_id}', 'App\Http\Controllers\API\CategoryController@childrenOfCat');

	##话题列表
	$api->get('post_found/{type?}','App\Http\Controllers\API\PostController@getPostsFound');

	##话题分类列表
	$api->get('post_cat_all','App\Http\Controllers\API\PostController@getCatsFound');

	##单页列表
	$api->get('single_page_list','App\Http\Controllers\API\PostController@getSingePageList');

	##单页详情
	$api->get('single_page/{slug}','App\Http\Controllers\API\PostController@getSingePageBySlug');

	##系统指定的功能
	$api->get('getSystemSettingFunc','App\Http\Controllers\API\CommonController@getSystemSettingFunc');
	/**
	 * 用户信息
	 */
	//$api->get('login', 'App\Http\Controllers\API\UserController@postLogin');

	##搜索商品
	$api->get('product_search','App\Http\Controllers\API\ProductController@apiProductSearch');
	
	##其他信息
    $api->get('timer', 'App\Http\Controllers\API\ProductController@giveFlashSaleTimer');

    ##功能开关列表
    $api->get('getFuncList','App\Http\Controllers\API\CommonController@getFuncList');
	//Route::any('notify_wechcat_pay', 'App\Http\Controllers\API\OrderController@payWechatNotify');
    ##当前主题
    $api->get('themeNow','App\Http\Controllers\API\CommonController@themeNow');

    ##所有功能配置项
    $api->get('getAllFunc','App\Http\Controllers\API\CommonController@getAllFunc');
    
    ##通知消息列表
    $api->get('getNotices','App\Http\Controllers\API\CommonController@getNotices');

    ##环球国家馆
    $api->get('countries','App\Http\Controllers\API\CommonController@countries');
    
    ##查询物流信息
    $api->get('search_logic','App\Http\Controllers\API\OrderController@getLogicInfo');

    #商铺信息
   	$api->get('stores','App\Http\Controllers\API\StoreController@storeWithProducts');
    
	$api->group(['middleware' => 'api.auth'], function ($api) {
		/**
		 * 用户中心
		 */
		# 退出登录
		$api->post('logout', 'App\Http\Controllers\API\UserController@postLogout');

		#获取用户信息
		$api->get('me', 'App\Http\Controllers\API\UserController@userInfo');

		#用户积分记录
		$api->get('credits', 'App\Http\Controllers\API\UserController@credits');

		#用户余额记录
		$api->get('funds', 'App\Http\Controllers\API\UserController@funds');

		#用户分佣记录
		$api->get('bouns', 'App\Http\Controllers\API\UserController@bouns');

		#推荐人列表
		$api->get('parterners', 'App\Http\Controllers\API\UserController@parterners');

		#优惠券列表
		$api->get('coupons/{type}', 'App\Http\Controllers\API\CouponController@coupons');

		#当前购物车能使用的优惠券
		$api->get('coupons_canuse', 'App\Http\Controllers\API\CouponController@couponsCanUse');

		#使用优惠券能得到的优惠
		$api->get('coupons_use/{coupon_id}', 'App\Http\Controllers\API\CouponController@couponsUse');

		/**
		 * 地址管理
		 */
		##设置默认地址
		$api->get('default_address/{address_id}/{default}','App\Http\Controllers\API\AddressController@default');

		##获取地址列表
		$api->get('get_address', 'App\Http\Controllers\API\AddressController@getAddressList');

		##获取单个地址详情
		$api->get('get_address/{address_id}', 'App\Http\Controllers\API\AddressController@getAddressOne');

		##增加地址
		$api->get('add_address', 'App\Http\Controllers\API\AddressController@addAddress');

		##修改地址
		$api->get('modify_address/{address_id}', 'App\Http\Controllers\API\AddressController@modifyAddress');

		##删除地址
		$api->get('delete_address/{address_id}', 'App\Http\Controllers\API\AddressController@deleteAddress');

		##获取省列表
		$api->get('provinces', 'App\Http\Controllers\API\AddressController@provinces');

		##根据地区id获取子列表
		$api->get('cities/{cities_id}', 'App\Http\Controllers\API\AddressController@cities');

		##获取区列表
		/*
		$api->get('districts/{city_id}', 'App\Http\Controllers\API\AddressController@districts');
		*/

		/**
		 * 商品收藏
		 */
		##获取收藏状态
		$api->get('get_collect/{product_id}', 'App\Http\Controllers\API\ProductController@getCollectStatus');

		##收藏动作
		$api->get('action_collect/{product_id}/{status}', 'App\Http\Controllers\API\ProductController@actionCollect');

		##个人中心收藏列表
		$api->get('list_collect', 'App\Http\Controllers\API\ProductController@listCollect');
	
		/**
		 * 订单信息
		 */
		#订单列表 1全部 2待付款 3待发货 4待确认 5退换货
		$api->get('orders/{type?}','App\Http\Controllers\API\OrderController@orders');

		##创建订单
		$api->post('order/create','App\Http\Controllers\API\OrderController@create');

		#订单详情
		$api->get('order/{id}','App\Http\Controllers\API\OrderController@detail');

		##取消订单
		$api->get('order/cancel/{id}','App\Http\Controllers\API\OrderController@cancel');
		
		##微信支付
		$api->get('pay_weixin/{order_id}','App\Http\Controllers\API\PayController@miniWechatPay');

		/**
		 * 购物车与结算
		 */
		#优惠金额计算
		$api->get('cart/preference','App\Http\Controllers\API\CartController@cartPreference');

		#运费计算
		$api->get('cart/freight','App\Http\Controllers\API\CartController@freight');
		
	});

});