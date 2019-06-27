<?php
    #商品促销
    $product_promp_active = Request::is('zcjy/productPromps*');
    #订单促销
    $order_promp_active = Request::is('zcjy/orderPromps*');
    #优惠券
    $coupon_active = Request::is('zcjy/coupons*') || Request::is('zcjy/couponRules*');
    #秒杀抢购
    $flashsales_active = Request::is('zcjy/flashSales*');
    #拼团
    $teamsales_active = Request::is('zcjy/teamSales*');
?>
<li class="header">促销</li>
@if(funcOpen('FUNC_PRODUCT_PROMP'))
        <li class="{{ $product_promp_active ? 'active' : '' }}">
            <a href="{!! route('productPromps.index') !!}"><i class="fa fa-edit"></i><span>商品促销</span></a>
        </li>
@endif

@if(funcOpen('FUNC_ORDER_PROMP'))
        <li class="{{ $order_promp_active ? 'active' : '' }}">
            <a href="{!! route('orderPromps.index') !!}"><i class="fa fa-edit"></i><span>订单促销</span></a>
        </li>
@endif

@if(funcOpen('FUNC_COUPON'))
        <li class="{{ $coupon_active ? 'active' : '' }}">
            <a href="{!! route('coupons.index') !!}"><i class="fa fa-edit"></i><span>优惠券</span></a>
        </li>
@endif

@if(funcOpen('FUNC_FLASHSALE'))
        <li class="{{ $flashsales_active ? 'active' : '' }}">
            <a href="{!! route('flashSales.index') !!}"><i class="fa fa-edit"></i><span>秒杀/抢购</span></a>
        </li>
@endif

@if(funcOpen('FUNC_TEAMSALE'))
        <li class="{{ $teamsales_active ? 'active' : '' }}">
            <a href="{!! route('teamSales.index') !!}"><i class="fa fa-edit"></i><span>拼团</span></a>
        </li>
@endif
