<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;

use ShoppingCart;
use App\User;
use Hash;
//支付宝
use AlipayTradeService;
use AlipayTradeWapPayContentBuilder;
use AopClient;
use AlipayFundTransToaccountTransferRequest;
use Log;
use EasyWeChat\Factory;

class AjaxController extends Controller
{

    /**
     * [购物车数量]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function shopCartNum(Request $request){
        return zcjy_callback_data(ShoppingCart::count(),0,'web');
    }

    //根据经纬度获取附近的商家
    public function getNearStores(Request $request){
           $input = $request->all();
           $jindu = null;
           $weidu = null;
           if(array_key_exists('jindu',$input) && array_key_exists('weidu',$input)){
                $jindu = $input['jindu'];
                $weidu = $input['weidu'];
           }

           $stores = app('commonRepo')->storeRepo()->stores();

           //为店铺添加距离
           foreach ($stores as $key => $val) {
                $val['distance'] = getDistance($jindu,$weidu,$val->jindu,$val->weidu);
           }
           if(!empty($jindu) && !empty($weidu)){
               $near_shop_distance = getSettingValueByKey('near_shop_distance');
               if(!empty($near_shop_distance)){
                    $stores = $stores->filter(function($store) use ($near_shop_distance) {
                        return $store->distance != '???' && $store->distance <= $near_shop_distance;
                    });
               }
           }
           return zcjy_callback_data($stores,0,'web');
    }

    //发送不通类型的验证码
    public function sendMobileCode(Request $request,$type=''){
        $input = $request->all();
        $varify = app('commonRepo')->varifyInputParam($input,'mobile');
        if($varify){
            return zcjy_callback_data($varify,1,'web');
        }
        $user = auth('web')->user();

        $allocat = ['access_key_id'=>'LTAIJ0IOf8uKIw09','access_key_secret'=>'KUN0haTW62gdc23lsXy9UjS5pZSdDG','sign_name'=>'暄妍科技','template'=>'SMS_142949506'];

        if($type == 'auth'){
            $allocat['template'] = 'SMS_142685050';
        }
       
        $request->session()->put('zcjy_code_'.$user->id.'_'.$type,app('commonRepo')->sendVerifyCode($input['mobile'],$allocat));

        return zcjy_callback_data('发送验证码成功',0,'web');
    }

    //设置支付密码
    public function setPayPwd(Request $request){
        $input = $request->all();
        $varify = app('commonRepo')->varifyInputParam($input,'mobile,code,password,enter_password');
        if($varify){
            return zcjy_callback_data($varify,1,'web');
        }
        $user = auth('web')->user();
        if(session('zcjy_code_'.$user->id.'_set_pay_pwd') != $input['code']){
            return zcjy_callback_data('验证码不正确',1,'web');
        }
        if($input['password'] != $input['enter_password']){
            return zcjy_callback_data('两次密码输入不一致',1,'web');
        }
        $user->update(['password-pay'=>Hash::make($input['password'])]);
        return zcjy_callback_data('设置支付密码成功',0,'web');
    }


    //用户余额提现
    public function userYueWithdrawl(Request $request){
        $input = $request->all();
        $varify = app('commonRepo')->varifyInputParam($input,'price,password,type');
        if($varify){
            return zcjy_callback_data($varify,1,'web');
        }

        $user = auth('web')->user();

        if($input['price'] < 1){
             return zcjy_callback_data('提现金额最低不能低于1元',1,'web');
        }
        $withdraw_min = getSettingValueByKey('withdraw_min');

        if($withdraw_min){
            if($input['price'] < $withdraw_min){
                 return zcjy_callback_data('提现金额'.$withdraw_min.'元起',1,'web');
            }
        }

        if(!Hash::check($input['password'],$user->{'password-pay'})){
            return zcjy_callback_data('支付密码错误',1,'web');
        }

        $bili = getSettingValueByKey('withdraw_bili');

        if($bili){
            #实际扣除手续费一起的费用
            $input['current_price'] = round(($input['price'] + $input['price']*$bili/100),2);
        }
        else{
            $input['current_price'] = $input['price'];
        }

        if($user->user_money < $input['current_price']){
           return zcjy_callback_data('您当前的余额不足以提现',1,'web');
        }


        #微信
        if($input['type'] == 'wechat'){
           $status = app('commonRepo')->companyGiveUserMoney($input,$user);
        }#支付宝
        elseif($input['type'] == 'alipay'){
          $status = app('commonRepo')->alipayGiveUserMoney($input,$user);
        }

        if(!$status){
            return zcjy_callback_data('发起成功',0,'web');
        }
        else{
             return zcjy_callback_data('当前系统账户余额不足或者服务器繁忙,请等会再试',1,'web');
        }
    }

    //用户余额充值
    public function userYueTopup(Request $request){
        $input = $request->all();
        $varify = app('commonRepo')->varifyInputParam($input,'price,type');
        if($varify){
            return zcjy_callback_data($varify,1,'web');
        }
        $user = auth('web')->user();
        #微信支付
        if($input['type'] == 'wechat'){
            #给支付参数
            $param = [];
            $out_trade_no = time().'_'.$user->id.'_8';
            $body = '易呗余额充值'.$input['price'].'元';
            $attributes = [
                'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
                'body'             => $body,
                'detail'           => '订单编号:'.$out_trade_no,
                'out_trade_no'     => $out_trade_no,
                'total_fee'        => intval( $input['price'] * 100 ), // 单位：分
                'notify_url'       => $request->root().'/notify_wechcat_pay', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
                'openid'           => $user->openid, // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
                'attach'           => '支付订单',
            ];
            $payment = Factory::payment(Config::get('wechat.payment.default'));
            $result = $payment->order->unify($attributes);
            if ($result['return_code'] == 'SUCCESS' && $result['result_code'] == 'SUCCESS'){
                $prepayId = $result['prepay_id'];
                $param = $payment->jssdk->bridgeConfig($prepayId);
                #添加订单
                app('commonRepo')->orderRepo()->create(['out_trade_no'=>$out_trade_no,'price'=>$input['price'],'snumber'=>time(),'user_id'=>$user->id]);
            }
        }#支付宝支付
        elseif($input['type'] == 'alipay'){
            $pay_num = time().'_'.$user->id;
            $payRequestBuilder = new AlipayTradeWapPayContentBuilder();
            $payRequestBuilder->setBody('易呗余额充值'.$input['price'].'元');
            $payRequestBuilder->setSubject('订单编号:'.$pay_num);
            $payRequestBuilder->setOutTradeNo($pay_num);
            $payRequestBuilder->setTotalAmount($input['price']);
            $payRequestBuilder->setTimeExpress("5m");

            $config = Config::get('alipay');
            $payResponse = new AlipayTradeService($config);
            #给支付跳转地址
            $param = $payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);
        }
        //Log::info($param);
        return zcjy_callback_data($param,0,'web');
    }


    //转赠货呗
    public function huobeiSend(Request $request){
        $input = $request->all();
        $varify = app('commonRepo')->varifyInputParam($input,'account,password-pay,num,current_num');
        if($varify){
            return zcjy_callback_data($varify,1,'web');
        }

        $recive_user = User::where('mobile',$input['account'])->first();

        if(empty($recive_user)){
            return zcjy_callback_data('转赠用户不存在',1,'web');
        }

        $cert_varify = app('commonRepo')->varifyCert($recive_user,'被转赠用户'); 

        if($cert_varify){
            return $cert_varify;
        }

        $user = auth('web')->user();

        //return Hash::check($input['password-pay'],Hash::make('zcjy123')) ? 'true' : 'false';

        if(!Hash::check($input['password-pay'],$user->{'password-pay'})){
            return zcjy_callback_data('支付密码错误',1,'web');
        }

        $credits_alias = getSettingValueByKeyCache('credits_alias');

        if($user->credits<$input['current_num']){
            return zcjy_callback_data('您账户的'.$credits_alias.'不足以转赠',1,'web');
        }

        #用户消耗
        $user->update(['credits'=>$user->credits-$input['current_num']]);

        #用户消耗积分记录
        app('commonRepo')->addCreditLog($user->credits,-$input['current_num'],'转赠给'.$recive_user->name.$input['num'].$credits_alias,3,$user->id);

        #被转赠者收到
        $recive_user->update(['credits'=>$recive_user->credits+$input['num']]);

        #被转赠者收到积分记录
        app('commonRepo')->addCreditLog($recive_user->credits,$input['num'],'收到'.$user->name.$input['num'].$credits_alias,1,$recive_user->id);
        return zcjy_callback_data('转赠成功',0,'web');
    }

    //货呗充值消耗
    public function huobeiTopup(Request $request){
        $input = $request->all();
        $varify = app('commonRepo')->varifyInputParam($input,'number,password');
        if($varify){
            return zcjy_callback_data($varify,1,'web');
        }
        $card = app('commonRepo')->cardRepo()->getCardByNumber($input['number']); 

        $credits_alias = getSettingValueByKeyCache('credits_alias');

        if(empty($card)){
            return zcjy_callback_data('该'.$credits_alias.'卡不存在',1,'web');
        }
        if($card->password != $input['password']){
            return zcjy_callback_data(''.$credits_alias.'卡密码输入错误',1,'web');
        }
        if($card->status){
            return zcjy_callback_data('该'.$credits_alias.'卡已被使用',1,'web');
        }
        $user = auth('web')->user();
        #把货呗余额加到用户账户余额下
        $user->update(['credits'=>$user->credits+$card->num]);
        #更新货呗卡的使用状态
        $card->update(['status'=>1]);
        #添加积分记录
        app('commonRepo')->addCreditLog($user->credits,$card->num,$credits_alias.'卡充值,充值'.$credits_alias.'卡号为'.$input['number'],5,$user->id);
        return zcjy_callback_data('使用'.$credits_alias.'卡成功,积分余额已实时到账,当前可用'.$credits_alias.$user->credits,0,'web');
    }

    //提交反馈
    public function submitFeedBack(Request $request){
        $request = $request->all();
        $varify = app('commonRepo')->varifyInputParam($request,app('commonRepo')->keFuFeedBackRepo()->model()::$rules,'key');
        if($varify){
            return zcjy_callback_data($varify,1,'web');
        }
        app('commonRepo')->keFuFeedBackRepo()->create($request);
        return zcjy_callback_data('提交反馈成功',0,'web');

    }

   /**
    * 图片文件上传
    */
    public function uploads(){
        $file =  Input::file('file');
        return app('commonRepo')->uploadFiles($file,'web',auth('web')->user());
    }

    //删除通知消息
    public function deleteMessage(Request $request){
        $input = $request->all();
        $varify = app('commonRepo')->varifyInputParam($input,'id');
        if($varify){
            return zcjy_callback_data($varify,1,'web');
        }
        $user = auth('web')->user();
        $varify = app('notice')->deleteNotice($user->id,$input['id']);
        if($varify){
            return zcjy_callback_data($varify,1,'web');
        }
        return zcjy_callback_data('删除消息成功',0,'web');
    }

    /**
     * 发起实名认证
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function certsPublish(Request $request){
        $input = $request->all();
        #验证字段
        $varify = app('commonRepo')->varifyInputParam($input,'name,id_card,mobile,code,face_image,back_image,hand_image,current_image_src');
        if($varify){
            return zcjy_callback_data($varify,1,'web');
        }
        #当前用户
        $user = auth('web')->user();
        #检查验证码
        if(session('zcjy_code_'.$user->id.'_auth') != $input['code']){
            return zcjy_callback_data('验证码输入错误',1,'web');
        }
        #处理数据类型
        if(!is_array($input['current_image_src'])){
            $input['current_image_src'] = explode(',',$input['current_image_src']);
        }
        #身份证正面
        $face_image_varify = app('commonRepo')->dealCardImage($input['current_image_src'][0]);
        #身份证反面
        $back_image = app('commonRepo')->dealCardImage($input['current_image_src'][1],2);
        #手持身份证
        $hand_image_varify = app('commonRepo')->dealCardImage($input['current_image_src'][2]);
        if($face_image_varify['msg'] == 'success' && $back_image['msg'] && $hand_image_varify['msg'] == 'success'){
            #检查身份证正反面和名字对不对得上
            if($face_image_varify['data']['number'] != $input['id_card'] || $face_image_varify['data']['name'] != $input['name'] || $hand_image_varify['data']['number'] != $input['id_card'] || $hand_image_varify['data']['name'] != $input['name']){
                return zcjy_callback_data('身份信息验证失败,请重新上传认证',1,'web');
            }
            #检查身份证有效期
            if(\Carbon\Carbon::parse($back_image['data']['end_date'])->lt(\Carbon\Carbon::now())){
                return zcjy_callback_data('身份证件已过期,请重新上传认证',1,'web');
            }
        }   
        else{
             return zcjy_callback_data('身份信息验证失败,请重新上传认证',1,'web');
        }
        #更新信息
        $user->update(['mobile'=>$input['mobile'],'name'=>$input['name']]);
        $input['user_id'] = $user->id;
        $input['status'] = '已通过';
        #添加认证记录
        app('commonRepo')->certsRepo()->create($input);
        return zcjy_callback_data('实名认证成功',0,'web');
    }

    //发起商品评价
    public function evalPublish(Request $request){
        $input = $request->all();
        $varify = app('commonRepo')->varifyInputParam($input,app('commonRepo')->productEvalRepo()->model()::$rules,'key');
        if($varify){
            return zcjy_callback_data($varify,1,'web');
        }
        $user = auth('web')->user();
        $input['user_id'] = $user->id;
        if(array_key_exists('anonymous', $input)){
            $input['anonymous'] = 1;
        }
        $eval = app('commonRepo')->productEvalRepo()->model()::create($input);
        app('commonRepo')->productEvalRepo()->attachEval($eval,$input);
        if(isset($input['item_id'])){
            app('commonRepo')->productEvalRepo()->dealItemTopiced($input['item_id']);
        }
        return zcjy_callback_data('添加评价成功',0,'web');
    }

    //删除评价
    public function evalDelete(Request $request,$eval_id){
        $eval = app('commonRepo')->productEvalRepo()->findWithoutFail($eval_id);
        if(empty($eval)){
            return zcjy_callback_data('没有找到该评价',1,'web');
        }
        $eval->delete();
        return zcjy_callback_data('删除评价成功',0,'web');
    }

    //点赞评价
    public function evalZan(Request $request,$eval_id){
        $eval = app('commonRepo')->productEvalRepo()->findWithoutFail($eval_id);
        if(empty($eval)){
            return zcjy_callback_data('没有找到该评价',1,'web');
        }
        $eval->update(['zan'=>$eval->zan + 1]);
        return zcjy_callback_data('点赞成功',0,'web');
    }

    /**
     * 异步通知 -支付宝
     */
    public function alipayWebNotify(Request $request)
    {
        $this->dealAlipayStatus($request->all(),true);
        return 'success';
    }

    /**
     * [处理支付宝的请求信息]
     * @param  [type]  $inputs      [description]
     * @param  boolean $need_status [description]
     * @return [type]               [description]
     */
    private function dealAlipayStatus($inputs,$need_status =false)
    {
          if (isset($inputs['trade_status']) &&  $need_status ? $inputs['trade_status'] == 'TRADE_SUCCESS' : true) {  
                if(isset($inputs['out_trade_no'])){
                    $inputs['out_trade_no'] = explode('_',$inputs['out_trade_no']);
                    $user = User::find($inputs['out_trade_no'][1]);
                    if(!empty($user) && isset($inputs['total_amount'])){
                        $inputs['total_amount'] = (float)$inputs['total_amount'];
                        $user->update(['user_money'=>$user->user_money+$inputs['total_amount']]);
                        #添加余额记录
                        app('commonRepo')->addMoneyLog($user->user_money,$inputs['total_amount'],'充值'.$inputs['total_amount'].'元到账户余额',4,$user->id);
                    }
                }
          }
    }

    /**
     * 同步通知 -支付宝
     */
    public function alipayWebReturn(Request $request)
    {
       $this->dealAlipayStatus($request->all());
      
        //支付成功跳转
        return redirect('/usercenter');
    }

    /**
     * 查询订单
     */
    public function queryOrders(Request $request)
    {
        $user = auth('web')->user();
        $input = $request->all();
        #验证字段
        $varify = app('commonRepo')->varifyInputParam($input,'word');
        if($varify){
            return zcjy_callback_data($varify,1,'web');
        }
        $orders = app('commonRepo')->orderRepo()->queryOrders($user,$input['word']);
        return zcjy_callback_data($orders,0,'web');

    }

    /**
     * 更新用户信息
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateUserInfo(Request $request)
    {
        $user = auth('web')->user();

        $input = $request->all();

        $user->update($input);

        return zcjy_callback_data('更新成功',0,'web');
    }

 
}
