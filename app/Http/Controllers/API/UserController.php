<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\UserLevel;

use App\Repositories\CouponRepository;
use App\Repositories\CouponUserRepository;
use App\Repositories\UserRepository;

use EasyWeChat\Factory;
use Config;
use Log;
use Storage;

class UserController extends Controller
{

	private $couponRepository;
    private $couponUserRepository;
    private $userRepository;
    public function __construct(
        UserRepository $userRepo,
        CouponUserRepository $couponUserRepo, 
        CouponRepository $couponRepo
    )
    {
        $this->couponRepository = $couponRepo;
        $this->couponUserRepository = $couponUserRepo;
        $this->userRepository=$userRepo;
    }

    /**
     * 小程序登录
     * @param  Request $requet [description]
     * @return [type]          [description]
     */
    public function loginMiniprogram(Request $requet)
    {
        $input = $requet->all();

        if (!$requet->has('code') || empty($requet->input('code'))) {
            return ['status_code'=>1,'data'=>'参数不正确'];
        }
        $app = Factory::miniProgram(Config::get('wechat.mini_program.default'));
        $result = $app->auth->session($requet->input('code'));

        Log::info($result);

        $unionid = null;
        if (array_key_exists('unionid', $result)) {
            $unionid = $result['unionid'];
        }

        $parent_id = null;
        if (array_key_exists('parent_id', $input)) {
            $parent_id = $input['parent_id'];
        }

        @$user = $this->userRepository->processRecommendRelation($result['openid'], $parent_id, $unionid);

        // $user = null;
        // if (array_key_exists('unionid', $result)) {
        //     //有UNION ID
        //     $user = User::where('unionid', $result['unionid'])->first();
        // } else {
        //     //只有OPEN ID
        //     $user = User::where('openid', $result['openid'])->first();
        // }
        // $newUser = false;
        // if (empty($user)) {
        //     //新用户
        //     //分销权限
        //     $is_distribute = 0;
        //     if (getSettingValueByKeyCache('distribution_condition') == '注册用户' && getSettingValueByKeyCache('distribution') == '是') {
        //         $is_distribute = 1;
        //     }
        //     //用户等级
        //     $first_level = \App\Models\UserLevel::orderBy('amount', 'asc')->first();
        //     $user_level  = empty($first_level) ? 0 : $first_level->id;

        //     $user = User::create([
        //         'openid' => $result['openid'],
        //         'unionid' => $result['unionid'],
        //         'user_level' => $user_level,
        //         'is_distribute' => $is_distribute
        //     ]);
        //     //处理推荐人关系
        //     if ($requet->has('parent_openid') && !empty($requet->input('parent_openid'))) {
                
        //     }

        //     $newUser = true;
        // }

        $this->updateUserInfo($user, $input['userInfo']);

        $token = auth()->login($user);

        return ['status_code' => 0, 'data' => ['token' => $token]];
    }

    public function updateUserInfo($user, $userInfo)
    {
        $userInfo = json_decode($userInfo, true);
        $user->update($userInfo);
    }

    /**
     * 用户登出
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postLogout(Request $request)
    {
    	auth()->logout();
    	return ['status_code' => 0, 'data' => '退出登录'];
    }

    /**
     * 获取用户信息带用户等级
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function userInfo(Request $request)
    {
    	$user = auth()->user();
    	$userLevel = null;
    	if( funcOpen('FUNC_MEMBER_LEVEL') ){
            $userLevel = UserLevel::where('id', $user->user_level)->first();
        }
        return ['status_code' => 0, 'data' => [
        	'user' => $user,
        	'userLevel' => $userLevel
        ]];
    }

    /**
     * 用户积分记录
     * @return [type] [description]
     */
    public function credits(Request $request)
    {
    	$user = auth()->user();
    	$skip = 0;
        $take = 18;
        if ($request->has('skip')) {
            $skip = $request->input('skip');
        }
        if ($request->has('take')) {
            $take = $request->input('take');
        }
        $creditLogs = $user->creditLogs()->skip($skip)->take($take)->get();
        return ['status_code' => 0, 'data' => $creditLogs];
    }

    /**
     * 用户余额记录
     * @param  Request $request [description]
     * @param  integer $skip    [description]
     * @param  integer $take    [description]
     * @return [type]           [description]
     */
    public function funds(Request $request)
    {
    	$user = auth()->user();
    	$take = 18;
        if ($request->has('skip')) {
            $skip = $request->input('skip');
        }
        if ($request->has('take')) {
            $take = $request->input('take');
        }
//        $moneyLogs = $user->moneyLogs()->skip($skip)->take($take)->get();
        $moneyLogs = $this->userRepository->moneyLogs($user, $skip, $take);
        return ['status_code' => 0, 'data' => $moneyLogs];
    }

    /**
     * 用户分佣记录
     * @param  Request $request [description]
     * @param  integer $skip    [description]
     * @param  integer $take    [description]
     * @return [type]           [description]
     */
    public function bouns(Request $request)
    {
    	$user = auth()->user();
    	$take = 18;
        if ($request->has('skip')) {
            $skip = $request->input('skip');
        }
        if ($request->has('take')) {
            $take = $request->input('take');
        }
        $moneyLogs = $this->userRepository->moneyLogs($user, $skip, $take, '分佣');
        return ['status_code' => 0, 'data' => $moneyLogs];
    }

    /**
     * 分销推荐人列表
     * @param  Request $request [description]
     * @param  integer $skip    [description]
     * @param  integer $take    [description]
     * @return [type]           [description]
     */
    public function parterners(Request $request)
    {
    	$user = auth()->user();
    	$take = 18;
        if ($request->has('skip')) {
            $skip = $request->input('skip');
        }
        if ($request->has('take')) {
            $take = $request->input('take');
        }
        $fellows = $this->userRepository->followMembers($user, $skip, $take);
        return ['status_code' => 0, 'data' => $fellows];
    }
    
    /**
     * 获取用户的优惠券
     * @param  Request $request [description]
     * @param  integer $type    [description]
     * @param  integer $skip    [description]
     * @param  integer $take    [description]
     * @return [type]           [description]
     */
    public function coupons(Request $request, $type = -1)
    {
    	$user = auth()->user();
    	$take = 18;
        if ($request->has('skip')) {
            $skip = $request->input('skip');
        }
        if ($request->has('take')) {
            $take = $request->input('take');
        }
        $coupons = $this->couponRepository->couponGetByStatus($user, $type, $skip, $take);
        return ['status_code' => 0, 'data' => $coupons];
    }

    public function distributionCode(Request $request)
    {
        $user = auth()->user();

        $folderpath = '/qrcodes'; 
        $filename = 'minicode_'.$user->id.'.png';

        $filepath = $folderpath.'/'.$filename;

        if(Storage::exists($filepath)){

            return ['status_code' => 0, 'data' => $filepath];

        } else {
            $app = Factory::miniProgram(Config::get('wechat.mini_program.default'));

            $response = $app->app_code->getUnlimit('user_id='.$user->id, [
                'page' => 'pages/index/index',
                'width' => 430
            ]);

            $filename = $response->saveAs(public_path().$folderpath, $filename);

            return ['status_code' => 0, 'data' => $filepath];
        }
    }

    public function distributionCodeOfProduct(Request $request)
    {
        $input = $request->all();
        if (!array_key_exists('product_id', $input)) {
            return ['status_code' => 1, 'data' => '参数不正确'];
        }

        $user = auth()->user();

        $folderpath = '/qrcodes'; 
        $filename = 'minicode_'.$user->id.'_product_'.$input['product_id'].'.png';

        $filepath = $folderpath.'/'.$filename;

        if(Storage::exists($filepath)){

            return ['status_code' => 0, 'data' => $filepath];

        } else {
            $app = Factory::miniProgram(Config::get('wechat.mini_program.default'));

            $response = $app->app_code->getUnlimit('user_id='.$user->id.'&product_id='.$input['product_id'], [
                'page' => 'pages/product/product',
                'width' => 430
            ]);

            $filename = $response->saveAs(public_path().$folderpath, $filename);

            return ['status_code' => 0, 'data' => $filepath];
        }
    }
    
}