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

class CouponController extends Controller
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


    public function couponsCanUse(Request $request)
    {
        $inputs = $request->all();
        $user = auth()->user();
        $coupons = $this->couponRepository->couponCanUse($user);

        $items = $inputs['items'];
        $items = json_decode($inputs['items'], true);

        $total = 0;
        foreach ($items as $item) {
            if (is_array($item)) {
                $item_qty = $item['qty'];
                $item_price = $item['price'];
                $total += $item_price * $item_qty;
            } else {
                $item_qty = $item->qty;
                $item_price = $item->price;
                $total += $item_price * $item_qty;
            }
        }

        //过滤不满足使用条件的优惠券
        $coupons = $coupons->filter(function ($coupon, $key) use($total, $items) {
            return app('commonRepo')->CouponPreference($coupon->id, $total, $items)['code'] == 0;
        });

        foreach ($coupons as $key => $coupon) {
            $coupon['coupon'] = $coupon->coupon;
        }


        return ['status_code' => 0, 'data' => $coupons];
    }
    

    public function couponsUse(Request $request, $coupon_id)
    {
        $inputs = $request->all();

        $items = $inputs['items'];
        $items = json_decode($inputs['items'], true);

        $total = 0;
        foreach ($items as $item) {
            if (is_array($item)) {
                $item_qty = $item['qty'];
                $item_price = $item['price'];
                $total += $item_price * $item_qty;
            } else {
                $item_qty = $item->qty;
                $item_price = $item->price;
                $total += $item_price * $item_qty;
            }
        }
        
        return ['status_code' => 0, 'data' => app('commonRepo')->CouponPreference($coupon_id, $total, $items)];
    }
}