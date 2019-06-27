<?php

namespace App\Repositories;

use App\User;
use App\Models\CouponRule;
use InfyOm\Generator\Common\BaseRepository;
use Carbon\Carbon;
use EasyWeChat\Factory;
use Storage;
use Image;
use Config;
use Log;

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'email_validated',
        'nickname',
        'password',
        'password-pay',
        'sex',
        'birthday',
        'head_image',
        'mobile',
        'qq',
        'openid',
        'unionid',
        'code',
        'share_qcode',
        'credits',
        'underling_number',
        'user_money',
        'frozen_money',
        'distribut_money',
        'consume_total',
        'last_login',
        'last_ip',
        'oauth',
        'province',
        'city',
        'district',
        'lock',
        'is_distribut',
        'leader1',
        'leader2',
        'leader3',
        'user_level'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    //处理推荐关系
    public function processRecommendRelation($user_openid, $parent_id, $user_unionid = null)
    {

        //$user = User::where('openid', $user_openid)->first();

        $user = null;
        //用户是否公众平台用户
        if ($user_unionid) {
            $user = User::where('unionid', $user_unionid)->first(); 
        }
        //不是，则是否是微信用户
        if (empty($user)) {
            $user = User::where('openid', $user_openid)->first();
        }

        //新用户注册才算
        if (empty($user)) {
            //推荐关系
            $parent = $this->findWithoutFail($parent_id);
            $grandParent = null;
            $grandGrandParent = null;
            if (!empty($parent) && $parent->leader1) {
                $grandParent = $this->findWithoutFail($parent->leader1);
                if (!empty($grandParent) && $grandParent->leader1) {
                    $grandGrandParent = $this->findWithoutFail($grandParent->leader1);
                }
            }
            $leader1 = 0;
            $leader2 = 0;
            $leader3 = 0;
            if (!empty($parent)) {
                $leader1 = $parent->id;
                $parent->update(['level1' => $parent->level1 + 1]);
            }
            if (!empty($grandParent)) {
                $leader2 = $grandParent->id;
                $grandParent->update(['level2' => $grandParent->level2 + 1]);
            }
            if (!empty($grandGrandParent)) {
                $leader3 = $grandGrandParent->id;
                $grandGrandParent->update(['level3' => $grandGrandParent->level3 + 1]);
            }
            $first_level = \App\Models\UserLevel::orderBy('amount', 'asc')->first();
            $user_level  = empty($first_level) ? 0 : $first_level->id;
            $is_distribute = 0;
            if (getSettingValueByKeyCache('distribution_condition') == '注册用户' && getSettingValueByKeyCache('distribution') == '是') {
                $is_distribute = 1;
            }
            $user = User::create([
                'openid' => $user_openid,
                'unionid' => $user_unionid,
                'leader1' => $leader1,
                'leader2' => $leader2,
                'leader3' => $leader3,
                'user_level' => $user_level,
                'is_distribute' => $is_distribute
            ]);
        }
        return $user;
    }

    /**
     * 新用户注册事件
     * @param  [type] $user [description]
     * @return [type]       [description]
     */
    function newUserCreated($user) {
        
        //积分赠送
        $this->creditsForNewUser($user);
        //优惠券赠送
        $this->conponForNewUser($user);
    }

    /**
     * 向新用户赠送积分
     * @param  [type] $user [description]
     * @return [type]       [description]
     */
    public function creditsForNewUser($user)
    {
        //积分赠送
        $register_credits = getSettingValueByKeyCache('register_credits');
        if ($register_credits) {
            $user->update(['credits' => $register_credits]);
            app('commonRepo')->addCreditLog($user->credits, $register_credits, '新用户注册赠送', 0, $user->id);
        }
        //推荐赠送的积分
        if ($user->leader1) {
            $parent = $this->findWithoutFail($user->leader1);
            if (!empty($parent)) {
                $invite_credits = getSettingValueByKeyCache('invite_credits');
                if ($invite_credits) {
                    $parent->update(['credits' => $parent->credits + $invite_credits]);
                    app('commonRepo')->addCreditLog($parent->credits, $invite_credits, '推荐用户'.$user->nickname.'注册赠送', 0, $parent->id);
                }
            }
        }
    }

    /**
     * 向新用户赠送优惠券
     * @param  [type] $user [description]
     * @return [type]       [description]
     */
    public function conponForNewUser($user)
    {
        if (empty($user)) {
            return;
        }
        //新用户注册送优惠券
        $curTime = Carbon::today();
        $newUserRules = CouponRule::where('type', 0)
        ->where('time_begin', '<=', $curTime)
        ->where('time_end', '>=', $curTime)
        //->whereRaw('count < max_count')
        ->where(function ($query) {
            $query->where('max_count', '=', 0)
                  ->orWhereColumn('count', '<', 'max_count');
        })->get();

        foreach ($newUserRules as $newUserRule) {
            $coupons = $newUserRule->coupons()->get();
            $newUserRule->update(['count' => $newUserRule->count + 1]);
            foreach ($coupons as $coupon) {
                app('commonRepo')->issueCoupon($user, $coupon, 1, '新用户注册');
            }
        }
        //推荐人送优惠券
        if (empty($user->leader1)) {
            return;
        }
        $parent = User::where('id', $user->leader1)->first();
        if (empty($parent)) {
            return;
        }

        //向推荐人赠送优惠券
        $newUserInviteRules = CouponRule::where('type', 2)
        ->where('time_begin', '<=', $curTime)
        ->where('time_end', '>=', $curTime)
        ->where(function ($query) {
            $query->where('max_count', '=', 0)
                  ->orWhereColumn('count', '<', 'max_count');
        })
        ->get();
        foreach ($newUserInviteRules as $newUserInviteRule) {
            $coupons = $newUserInviteRule->coupons()->get();
            $newUserInviteRule->update(['count' => $newUserInviteRule->count + 1]);
            foreach ($coupons as $coupon) {
                app('commonRepo')->issueCoupon($parent, $coupon, 1, '推荐新用户注册');
            }
        }
    }

    /**
     * 分享二维码
     * @param  [type] $user [description]
     * @return [type]       [description]
     */
    public function erweima($user)
    {
        if (empty($user->share_qcode)) {
            $app = app('wechat.official_account');
            $result = $app->qrcode->forever($user->id);
            $url = $app->qrcode->url($result['ticket']);
            $user->update(['share_qcode' => $url]);
        }
        $share_img = public_path().'/qrcodes/user_share'.$user->id.'.png';
        if(!Storage::exists($share_img)){
            //share_qrcode_img
            $base_image = getSettingValueByKeyCache('share_qrcode_img');
            if (empty($base_image)) {
                $base_image = public_path().'/images/'.theme()['name'].'/share_base.png';
            }
            $img = Image::make($base_image);
            $qcode = Image::make($user->share_qcode)->resize(260, 260);
            $img->insert($qcode, 'top-left', 163, 174);
            $img->save($share_img, 70);
        }
        $share_img ='/qrcodes/user_share'.$user->id.'.png';
        return $share_img;
    }


    public function collections($user, $skip = 0, $take = 18)
    {
        $products = $user->collections()->orderBy('created_at', 'desc')->skip($skip)->take($take)->get();
        return $products;
    }

    public function followMembers($user, $skip = 0, $take = 18)
    {
        $fellows = User::where('leader1', $user->id)->select('id', 'head_image', 'nickname', 'created_at')->skip($skip)->take($take)->get();
        return $fellows;
    }

    /**
     * 用户账户余额记录
     * @param  [type]  $user [description]
     * @param  integer $skip [description]
     * @param  integer $take [description]
     * @return [type]        [description]
     */
    public function moneyLogs($user, $skip = 0, $take = 18, $type = null,$sort='asc')
    {
        $query = $user->moneyLogs();
        if (!empty($type)) {
            $query = $query->where('type', $type);
        }
        $logs = $query->orderBy('created_at',$sort)->skip($skip)->take($take)->get();
        $logs = app('commonRepo')->attachWeek($logs);
        $logs = app('commonRepo')->dealTimeFormat($logs);
        return $logs;
    }



    /**
     * 用户订单信息
     * @param  [type]  $user       [description]
     * @param  [type]  $promp_type [description]
     * @param  integer $skip       [description]
     * @param  integer $take       [description]
     * @return [type]              [description]
     */
    public function orderOfPrompType($user, $promp_type, $skip = 0, $take = 18)
    {
        return $user->orders()->where('prom_type', $promp_type)->skip($skip)->take($take)->get();
    }

    public function orderOfUser($user, $skip = 0, $take = 18)
    {
        return $user->orders()->skip($skip)->take($take)->get();
    }

}
