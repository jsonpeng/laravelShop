<?php

use Illuminate\Support\Facades\Config;

//用户账户
//Route::get('/login','Front\AuthController@login');
//Route::post('/user/login','Front\AuthController@postLogin');
Route::get('test',function(){
	dd(ees5());
});
/**
 * 后台功能功能，如果做成插件则不需要这些功能
 
Route::group([ 'prefix' => 'auth'], function () {
	Route::get('login', 'Auth\AuthController@getLogin');
	Route::post('login', 'Auth\AuthController@postLogin');
	Route::get('logout', 'Auth\AuthController@getLogout');

	// Registration Routes...
	Route::get('register', 'Auth\AuthController@getRegister');
	Route::post('register', 'Auth\AuthController@postRegister');

	// Password Reset Routes...
	Route::get('password/reset', 'Auth\PasswordController@getEmail');
	Route::post('password/email', 'Auth\PasswordController@postEmail');
	Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
	Route::post('password/reset', 'Auth\PasswordController@postReset');
});*/

//
//获取分类别名
Route::get('/getRootSlug/{cat_id}','Admin\ArticlecatsController@getCatRootSlug');
//刷新缓存
Route::post('/clearCache','AppBaseController@clearCache');
//地图
Route::get('map','Admin\SettingController@map');

Route::get('403',function(){
   return view('errors.403');
});

//在页面中的URL尽量试用ACTION来避免前缀的干扰
Route::group([ 'prefix' => 'zcjy', 'namespace' => 'Admin\Auth'], function () {
	//登录
	Route::get('login', 'LoginController@showLoginForm');
	Route::post('login', 'LoginController@login');
	Route::get('logout', 'LoginController@logout');

	//重置密码
	Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
	Route::post('password/reset', 'ResetPasswordController@reset');
	Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');

});

Route::post('/zcjy/cities/getAjaxSelect/{id}','Admin\CitiesController@CitiesAjaxSelect');



Route::group([ 'middleware' => ['auth.admin:admin'], 'prefix' => 'zcjy', 'namespace' => 'Admin'], function () {

	Route::get('/', 'OrderController@index');

	/**
	 * ajax操作
	 */
	Route::group([ 'prefix' => 'ajax' ], function () {
		//积分修改
		Route::post('/user/{user_id}/credits_change','UserController@updateUserCredits');
		//余额修改
		Route::post('/user/{user_id}/money_change','UserController@updateUserMoney');
		//主题颜色设置
	    Route::post('/set_theme_color', 'SettingController@postThemeSetting');
	    //根据城市id返回对应的运费模板信息
	    Route::get('/getfreighttem/cid/{cid}','CitiesController@GetFreightTemByCid');
	    //文章额外字段设置
	    Route::post('/wordset/{id}','ProductController@wordsListUpdate');
	    //为当前管理员赋予权限
	    Route::post('/perm/{id}/add','PermissionsController@addPermToAdmin');
	    //为当前管理员移除权限
	    Route::post('/perm/{id}/del','PermissionsController@delPermToAdmin');
	    //冻结用户
	    Route::post('/freezeuser/{userid}','UserController@freezeUserById');
	    //操作分销资格
	    Route::post('/distributeUser/{userid}','UserController@distributeUser');
	    //图片上传
	    Route::post('/uploads','AjaxController@uploadImage');
	    //发送通知消息
	    Route::get('/send_notices','AjaxController@sendNotices');
	});

	/**
	 * iframe操作
	 */
	Route::group(['prefix'=>'iframe'],function(){

		Route::get('card/list','CardController@iframeList');

	});

	//店铺管理
	Route::resource('stores', 'StoreController');
	//店铺分类管理
	Route::resource('cats', 'CatsController');
	//项目管理
	Route::resource('projects', 'ProjectsController');
	//积分卡批量导出
	Route::post('cardsExport','CardController@exportAll')->name('cards.export');
	//积分卡批量删除
	Route::post('cardsDeleteMany','CardController@deleteMany')->name('cards.deletemany');
	//货呗积分卡管理
	Route::resource('cards', 'CardController');
	//实名认证管理
	Route::resource('certs', 'CertsController');
	//会员等级
	Route::resource('userLevels', 'UserLevelController');
	//会员管理
	Route::resource('users', 'UserController'); 
	//客服反馈管理
	Route::resource('keFuFeedBacks', 'KeFuFeedBackController');

	//查找分类信息
    Route::get('categories/searchCatsFrame','CategoryController@searchCatsFrame');
    
	//产品分类
	Route::resource('categories', 'CategoryController');
	Route::get('childCategories/{parent_id}', 'CategoryController@categoriesOfParent'); 
	//产品模型
	Route::resource('productTypes', 'ProductTypeController');
	//产品规格
	Route::resource('specs', 'SpecController');
	//商品属性
	Route::resource('productAttrs', 'ProductAttrController');
	//产品品牌查找
	Route::get('brands/iframe','BrandController@iframe');
	//产品品牌
	Route::resource('brands', 'BrandController');
	//产品管理
	Route::get('products/ajaxGetSpecSelect', 'ProductController@ajaxGetSpecSelect');
    //allLowGoods
    //商品库存报警列表
    Route::get('all_products/allLowGoods','ProductController@allLowGoods')->name('products.alllow');
    //获取商品规格组合列表
    Route::post('products/ajaxGetProductList','ProductController@ajaxGetProductList');
    //根据商品id获取商品信息
    Route::post('products/getSingleProductById/{id}','ProductController@getSingleProductById');
    //商品附加信息列表
    Route::get('word_products','ProductController@wordsList')->name('wordlist.index');
    Route::get('word_products/add','ProductController@wordsListAdd')->name('wordlist.create');
    Route::post('word_products/add','ProductController@wordsListStore')->name('wordlist.store');
    Route::post('word_products/delete/{id}','ProductController@wordsListDestroy')->name('wordlist.destroy');

    //查找商品信息
    Route::get('products/searchGoodsFrame','ProductController@searchGoodsFrame');
    

	Route::post('products/ajaxGetSpecInput/{product_id}', 'ProductController@ajaxGetSpecInput'); 
	Route::get('products/ajaxGetAttrInput', 'ProductController@ajaxGetAttrInput'); 
	Route::post('products/ajaxSaveTypeAttr/{product_id}', 'ProductController@ajaxSaveTypeAttr');
	Route::post('products/ajaxDelSpecInputByKey', 'ProductController@ajaxDelSpecInputByKey');
	
	Route::resource('products', 'ProductController');
	Route::resource('productImages', 'ProductImageController');
	//订单管理
    //订单中加入商品
    Route::get('/order/print/{id}','OrderController@print');
    Route::post('orders/addProductList','OrderController@addProductList');
    Route::post('orders/delProductList/{item_id}','OrderController@delProductList');
    Route::get('orders/{id}/delete','OrderController@deleteOrder');
	Route::get('orders/{id}/print', 'OrderController@printOrder'); 
	Route::get('orders/{id}/tripperprint', 'OrderController@tripperprintOrder')->name('order.print');

    Route::post('orders/{order_id}/report', 'OrderController@reportOrder')->name('order.report');
    //reportOrderToMany
    Route::post('orders/reportMany', 'OrderController@reportOrderToMany')->name('order.report.many');

	Route::resource('orders', 'OrderController');
	Route::resource('orderActions', 'OrderActionController'); //订单操作记录
	Route::resource('orderCancels', 'OrderCancelController'); //取消订单
	Route::resource('refundMoneys', 'RefundMoneyController'); // 退款信息查询

	Route::get('refunds/{id}/update','OrderRefundController@getUpdate');
	Route::resource('orderRefunds', 'OrderRefundController'); //退换货
	//订单商品
	Route::resource('items', 'ItemController');
	//滚动横幅
	Route::resource('banners', 'BannerController');
    Route::resource('{banner_id}/bannerItems', 'BannerItemController');

	//统计信息
	Route::get('statics', 'StatController@index')->name('stat.index');
	Route::post('report', 'StatController@report')->name('stat.report');

	Route::resource('managers', 'ManagerController');

	Route::resource('themes', 'ThemeController');

	//商城设置
	Route::get('settings/system', 'SettingController@system')->name('settings.system');
	Route::get('settings/setting', 'SettingController@setting')->name('settings.setting');
	Route::post('settings/setting', 'SettingController@update')->name('settings.setting.update');
	Route::get('settings/themeSetting', 'SettingController@themeSetting')->name('settings.themeSetting');
	Route::get('settings/themeSetting/{theme}', 'SettingController@themeSettingActive')->name('settings.themeSettingActive');
	

	// 三级分销
	Route::get('distributions/stats', 'DistributionController@stats')->name('distributions.stats');
	Route::get('distributions/lists', 'DistributionController@lists')->name('distributions.lists');
	Route::get('distributions/settings', 'DistributionController@settings')->name('distributions.settings');

	//分销分佣记录
	Route::resource('distributionLogs', 'DistributionLogController');

	//优惠券
	Route::get('coupons/given', 'CouponController@given')->name('coupons.given');
    Route::post('coupons/given', 'CouponController@postGiven');
    //用户列表
    Route::get('/frame/givenUserList','CouponController@givenUserList');

	Route::get('coupons/given_integer', 'CouponController@givenInteger')->name('coupons.integer');
	Route::post('coupons/given_integer', 'CouponController@postGivenInteger');
	Route::get('coupons/stats', 'CouponController@stats')->name('coupons.stats');
	Route::resource('coupons', 'CouponController');
	Route::resource('couponRules', 'CouponRuleController');

    Route::get('Promps/pageSet','ProductPrompController@prompPageSetView')->name('promps.pageset');
    Route::post('Promps/pageSetApi','ProductPrompController@prompPageSetApi')->name('promps.pageset.update');
	//产品促销
	Route::resource('productPromps', 'ProductPrompController');
	//订单促销
	Route::resource('orderPromps', 'OrderPrompController');
	//秒杀
	Route::resource('flashSales', 'FlashSaleController');
	//拼团列表
	Route::resource('teamSales', 'TeamSaleController');
	Route::resource('teamFounds', 'TeamFoundController');
	Route::resource('teamFollows', 'TeamFollowController');
	Route::resource('teamLotteries', 'TeamLotteryController');
	//团购列表
	Route::resource('groupSales', 'GroupSaleController');
    //银行卡设置
    Route::resource('bankSets', 'BankSetsController');
	//管理员管理
    Route::resource('managers','AdminSetsController');
	//角色管理
	 Route::resource('roles', 'RoleController');
	 //权限管理
    Route::resource('permissions','PermissionsController');
    //地区设置
    Route::resource('cities','CitiesController');
    //运费模板
    Route::resource('freightTems', 'FreightTemController');
    //根据pid查看到地区列表
    Route::get('cities/pid/{pid}','CitiesController@ChildList')->name('cities.child.index');
    //为指定父级城市添加地区页面
    Route::get('cities/pid/{pid}/add','CitiesController@ChildCreate')->name('cities.child.create');
    //省市区三级选择
    Route::get('cities/frame/select','CitiesController@CitiesSelectFrame')->name('cities.select.frame');
    //直接根据id返回市区县地区列表
    Route::post('cities/getAjaxSelect/{id}','CitiesController@CitiesAjaxSelect');

;
    //地区对应的模板信息
    Route::get('cities/frame/freighttem/{cid}','CitiesController@GetFreightTemByCidFrame')->name('cities.freighttem.frame');

    //单页面
    Route::resource('singelPages', 'SingelPageController');
    //客服
    Route::resource('customerServices', 'CustomerServiceController');
    //钱包用户操作记录
    Route::resource('withDrawls', 'WithDrawlController');
    
    //新加文章
    //文章分类
    Route::resource('articlecats', 'ArticlecatsController');
    //文章
    Route::resource('posts', 'PostController');
    //自定义文章类型
    Route::resource('customPostTypes', 'CustomPostTypeController');
    //获取所有自定义文章类型
    Route::post('getCustomType','PostController@getCustomType');
    //自定义文章详细字段
    Route::resource('{customposttype_id}/customPostTypeItems', 'CustomPostTypeItemsController');
    //自定义页面类型
    Route::resource('customPageTypes', 'CustomPageTypeController');
    //自定义页面详细字段
    Route::resource('{page_id}/pageItems', 'PageItemsController');
    //页面
    Route::resource('pages', 'PageController');
    //产地
    Route::resource('countries', 'CountryController');
    //通知消息
    Route::resource('notices', 'NoticeController');
    //评价管理
    Route::resource('productEvals', 'ProductEvalController');

    //微信公众号功能
    Route::group([ 'prefix' => 'wechat'], function () {
    	Route::group([ 'prefix' => 'menu'], function () {
			Route::get('menu', 'Wechat\MenuController@getIndex')->name('wechat.menu');
			Route::get('lists', 'Wechat\MenuController@getLists');
			Route::get('create', 'Wechat\MenuController@getCreate');
			Route::get('delete/{id}', 'Wechat\MenuController@getDelete');
			Route::get('update/{id}', 'Wechat\MenuController@getUpdate');
			Route::get('single/{id}', 'Wechat\MenuController@getSingle');
			Route::post('store', 'Wechat\MenuController@postStore');
			Route::get('update-menu-event', 'Wechat\MenuController@getUpdateMenuEvent');
		});

		Route::group([ 'prefix' => 'reply'], function () {
			Route::get('/', 'Wechat\ReplyController@getIndex');
			Route::get('index', 'Wechat\ReplyController@getIndex')->name('wechat.reply');
			Route::get('rpl-follow', 'Wechat\ReplyController@getRplFollow');
			Route::get('rpl-no-match', 'Wechat\ReplyController@getRplNoMatch');
			Route::get('follow-reply', 'Wechat\ReplyController@getFollowReply');
			Route::get('no-match-reply', 'Wechat\ReplyController@getNoMatchReply');
			Route::get('lists', 'Wechat\ReplyController@getLists');
			Route::get('save-event-reply', 'Wechat\ReplyController@getSaveEventReply');
			Route::post('store', 'Wechat\ReplyController@postStore');
			Route::get('edit/{id}', 'Wechat\ReplyController@getEdit');
			Route::post('update/{id}', 'Wechat\ReplyController@postUpdate');
			Route::get('delete/{id}', 'Wechat\ReplyController@getDelete');
			Route::get('single/{id}', 'Wechat\ReplyController@getSingle');
			Route::get('delete-event/{type}', 'Wechat\ReplyController@getDeleteEvent');
		});

		Route::group([ 'prefix' => 'material'], function () {
			Route::get('by-event-key/{key}', 'Wechat\MaterialController@getByEventKey');
		});
	});

});

// Route::resource('creditLogs', 'CreditLogController');

// Route::resource('moneyLogs', 'MoneyLogController');

// Route::resource('orderCancelImages', 'OrderCancelImageController');

// Route::resource('refundLogs', 'RefundLogController');







