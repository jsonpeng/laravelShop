<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Category;
use App\Models\Theme;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Repositories\CouponRepository;
use App\Repositories\ProductRepository;


use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Mail;
use App\Models\Order;
use App\Models\Notice;

class IndexController extends Controller
{

    private $couponRepository;
    // private $bannerRepository;
    private $productRepository;
    
    

    public function __construct(
        ProductRepository $productRepo, 
        CouponRepository $couponRepo
    )
    {
        $this->couponRepository = $couponRepo;
        $this->productRepository = $productRepo;
    }

    //商城首页
    public function index(Request $request){

        //获取推荐分类给前端
        $categories = Category::where('recommend', 1)->orderBy('sort', 'desc')->get();
        //秒杀倒计时给前端需要倒计时的时间
        $cur = processTime( Carbon::now() );
        $time = $cur->copy()->addHours(2);
        //获取手动领取的优惠券
        $coupons=$this->couponRepository->getCouponOfRule(4);
        $user = auth('web')->user();
        $unread_messages_num = count(app('notice')->allNotices($user->id,true));
        return view(frontView('index'), compact('categories', 'time', 'coupons','unread_messages_num'));
    }

    //用户领取优惠券
    public function userGetCoupons($coupons_id){
        if(auth('web')->check()){
            $user = auth('web')->user();
            app('commonRepo')->processGivenCoupon([$user], [$coupons_id], 1, '手动领取');
            return ['code'=>0,'message'=>'领取成功'];
        }else{
            return ['code'=>1,'message'=>'请先登录'];
        }
    }

    public function notice(Request $request, $id)
    {
        $notice = notice($id);
        if (empty($notice)) {
            return redirect('/');
        }
        return view(frontView('notices.detail'), compact('notice'));
    }

    //物流查询
    public function logistics(Request $request){
        $type=$request->input('type');
        $postid=$request->input('postid');
        $html= file_get_contents('https://m.kuaidi100.com/index_all.html');

        return view(frontView('logistics.index'), compact('type','postid','html'));
    }

    //修改电话
    public function editMobile(){
        return view(frontView('integral.editmobile'));
    }

    //修改密码
    public function editPwd(){
        return view(frontView('integral.editpwd'));
    }

    //发布评价
    public function publishEva(Request $request){
        $input = $request->all();
        $product = null;
        $spec = null;

        if(!isset($input['item_id']))
        {
            return redirect('/');
        }

        if(isset($input['product_id'])){
            $product = $this->productRepository->product($input['product_id']);
        }

        if(isset($input['spec_keyname']) && !empty($input['spec_keyname'])){
            $spec = $this->productRepository->spec($input['spec_keyname']);
        }
        
        return view(frontView('integral.publisheva'),compact('product','spec','input'));
    }

    //附近商家
    public function nearShops(){
        return view(frontView('integral.nearshops'));
    }

    //通知消息
    public function messages(){
        $user = auth('web')->user();
        $messages = app('notice')->allNotices($user->id);
        #批量设置为已读
        app('notice')->readedNotice($user->id);
        return view(frontView('message.index'),compact('messages'));
    }
    
    //服务商户
    public function serviceShops($id=null){
        #店铺分类
        $cats = app('commonRepo')->storeRepo()->storesCats();
        $cat = null;
        #分类下店铺
        if($id == 'null' || empty($id)){
            $stores = app('commonRepo')->storeRepo()->storesWithCats();
        }
        else{
            $cat = app('commonRepo')->catsRepo()->findWithoutFail($id);
            $stores = app('commonRepo')->storeRepo()->storesWithCats($id);
        }
      return view(frontView('integral.serviceshops'),compact('cats','stores','cat'));
    }

    //企业店铺
    public function companyShop($id){
         $store = app('commonRepo')->storeRepo()->findWithoutFail($id);
         if(empty($store)){
            return redirect('/');
         }
         $products = $store->products;
         return view(frontView('integral.companyshop'),compact('store','products'));
    }

    //实名认证
    public function cert(Request $request){
         $user = auth('web')->user();
         $cert = $user->cert()->first();
         if(!empty($cert)){
            return redirect('/integral/cert_success');
         }
         return view(frontView('integral.cert'));
    }

    //提交成功及认证信息
    public function certSuccess(Request $request){
         $user = auth('web')->user();
         $cert = $user->cert()->first();
         if(empty($cert)){
             return redirect('/integral/cert');
         }
         return view(frontView('integral.certsuccess'),compact('user','cert'));
    }

    //贝壳转赠
    public function giving(Request $request){
         return view(frontView('integral.giving'));
    }

    //我的评价
    public function myeval(Request $request){
        $user = auth('web')->user();
        $evals = app('commonRepo')->productEvalRepo()->myEval($user->id);
        return view(frontView('integral.myeval'),compact('evals'));
    }

    //我的钱包
    public function mywallet(Request $request){
        $user = auth('web')->user();
        $creditLogs = app('commonRepo')->creditLogRepo()->creditLogs($user, 0, 18);
        $moneyLogs = app('commonRepo')->userRepo()->moneyLogs($user, 0, 18);
        return view(frontView('integral.mywallet'),compact('user','moneyLogs','creditLogs'));
    }

    //客服列表
    public function  kefulist(Request $request){
        $kefus = app('commonRepo')->customerServiceRepo()->allKefus();
        return view(frontView('integral.kefulist'),compact('kefus'));
    }

    //客服反馈
    public function kefuFeedBack(Request $request){
        return view(frontView('integral.kefufeedback'));
    }


    //余额充值
    public function userMoneyTopup(Request $request){
        return view(frontView('integral.usermoneytopup'));
    }

    //货呗充值
    public function creditsTopup(Request $request){
         return view(frontView('integral.creditstopup'));
    }

    //设置
    public function meSetting(Request $request){
        $user = auth('web')->user();
        return view(frontView('integral.setting'),compact('user'));
    }

    //修改支付密码
    public function setPayPassword(Request $request){
        $user = auth('web')->user();
        return view(frontView('integral.setpaypassword'),compact('user'));
    }

    //修改昵称
    public function setNickname(Request $request){
        $user = auth('web')->user();
        return view(frontView('integral.setnickname'),compact('user'));
    }

    //修改手机号
    public function setMobile(Request $request){
        $user = auth('web')->user();
        return view(frontView('integral.setmobile'),compact('user'));
    }

    //设置性别
    public function setSex(Request $request)
    {
        $user = auth('web')->user();
        return view(frontView('integral.setsex'),compact('user'));
    }

}
