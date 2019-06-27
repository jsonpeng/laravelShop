@extends('admin.layouts.app')


@section('content')

<div class="container-fluid" style="padding: 30px 15px;">
    <div class="row">
        <div class="col-sm-3 col-lg-2">
            <ul class="nav nav-pills nav-stacked nav-email">
                <li class="{{ Request::is('zcjy/settings/setting*') ? 'active' : '' }}">
                    <a href="{!! route('settings.setting') !!}"><i class="fa fa-edit"></i><span>网站设置</span></a>
                </li>
                <li class="{{ Request::is('zcjy/settings/system') ? 'active' : '' }}">
                    <a href="{!! route('settings.system') !!}"><i class="fa fa-edit"></i><span>系统功能</span></a>
                </li>
                @if( Config::get('web.FUNC_THEME') || Config::get('web.FUNC_COLOR'))
                <li class="{{ Request::is('zcjy/settings/themeSetting*') ? 'active' : '' }}">
                    <a href="{!! route('settings.themeSetting') !!}"><i class="fa fa-edit"></i><span>主题设置</span></a>
                </li>
                @endif
            </ul>
        </div>

        <div class="col-sm-9 col-lg-10">
            <div class="container">
                <section class="content pdall0-xs pt10-xs">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li>
                                <a href="javascript:;">
                                    <span style="font-weight: bold;">系统功能</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="box box-info form">
                                    <!-- form start -->
                                    <div class="box-body">
                                        <form class="form-horizontal" id="form1">

                                            {{-- 优惠活动 --}}
                                            @if (Config::get('web.FUNC_PRODUCT_PROMP'))
                                                <div class="col-sm-4 item">
                                                    <div class="row">
                                                        <div class="col-sm-6">优惠活动</div>
                                                        <div class="col-sm-6"><span>关闭</span>/<span>开启</span></div>
                                                    </div>
                                                    @if (Config::get('web.FUNC_BRAND'))
                                                    <div class="form-group">
                                                        <label for="FUNC_BRAND" class="col-sm-6 control-label"><i class="fa fa-circle-o"></i>品牌街</label>
                                                        <div class="col-sm-6">
                                                            <input class="weui-switch" type="checkbox" name="FUNC_BRAND" @if(sysOpen('FUNC_BRAND') == '1') checked="checked" @endif />
                                                        </div>
                                                    </div>
                                                    @endif
                                                    
                                                    @if (Config::get('web.FUNC_PRODUCT_PROMP'))
                                                    <div class="form-group">
                                                        <label for="FUNC_PRODUCT_PROMP" class="col-sm-6 control-label"><i class="fa fa-circle-o"></i>商品促销</label>
                                                        <div class="col-sm-6">
                                                            <input class="weui-switch" type="checkbox" name="FUNC_PRODUCT_PROMP" @if(sysOpen('FUNC_PRODUCT_PROMP') == '1') checked="checked" @endif />
             
                                                        </div>
                                                    </div>
                                                    @endif

                                                    @if (Config::get('web.FUNC_ORDER_PROMP'))
                                                    <div class="form-group">
                                                        <label for="FUNC_ORDER_PROMP" class="col-sm-6 control-label"><i class="fa fa-circle-o"></i>订单优惠</label>
                                                        <div class="col-sm-6">
                                                            <input class="weui-switch" type="checkbox" name="FUNC_ORDER_PROMP" @if(sysOpen('FUNC_ORDER_PROMP') == '1') checked="checked" @endif />
                  
                                                        </div>
                                                    </div>
                                                    @endif

                                                    @if (Config::get('web.FUNC_FLASHSALE'))
                                                    <div class="form-group">
                                                        <label for="FUNC_FLASHSALE" class="col-sm-6 control-label"><i class="fa fa-circle-o"></i>秒杀</label>
                                                        <div class="col-sm-6">
                                                            <input class="weui-switch" type="checkbox" name="FUNC_FLASHSALE" @if(sysOpen('FUNC_FLASHSALE') == '1') checked="checked" @endif />
                 
                                                        </div>
                                                    </div>
                                                    @endif
                                                    
                                                    @if (Config::get('web.FUNC_COUPON'))
                                                    <div class="form-group">
                                                        <label for="FUNC_COUPON" class="col-sm-6 control-label"><i class="fa fa-circle-o"></i>优惠券</label>
                                                        <div class="col-sm-6">
                                                            <input class="weui-switch" type="checkbox" name="FUNC_COUPON" @if(sysOpen('FUNC_COUPON') == '1') checked="checked" @endif />
                
                                                        </div>
                                                    </div>
                                                    @endif

                                                    
                                                    @if (Config::get('web.FUNC_TEAMSALE'))
                                                    <div class="form-group">
                                                        <label for="FUNC_TEAMSALE" class="col-sm-6 control-label"><i class="fa fa-circle-o"></i>拼团</label>
                                                        <div class="col-sm-6">
                                                            <input class="weui-switch" type="checkbox" name="FUNC_TEAMSALE" @if(sysOpen('FUNC_TEAMSALE') == '1') checked="checked" @endif />
               
                                                        </div>
                                                    </div>
                                                    @endif


                                                </div>
                                            @endif


                                            {{-- 会员分销 --}}
                                            @if (Config::get('web.FUNC_DISTRIBUTION'))
                                                <div class="col-sm-4 item">
                                                    <div class="row">
                                                        <div class="col-sm-6">会员分销</div>
                                                        <div class="col-sm-6"><span>关闭</span>/<span>开启</span></div>
                                                    </div>
                                                    @if (Config::get('web.FUNC_DISTRIBUTION'))
                                                    <div class="form-group">
                                                        <label for="FUNC_DISTRIBUTION" class="col-sm-6 control-label"><i class="fa fa-circle-o"></i>分销</label>
                                                        <div class="col-sm-6">
                                                            <input class="weui-switch" type="checkbox" name="FUNC_DISTRIBUTION" @if(sysOpen('FUNC_DISTRIBUTION') == '1') checked="checked" @endif />
                                                        </div>
                                                    </div>
                                                    @endif

                                                    @if (Config::get('web.FUNC_MEMBER_LEVEL'))
                                                    <div class="form-group">
                                                        <label for="FUNC_MEMBER_LEVEL" class="col-sm-6 control-label"><i class="fa fa-circle-o"></i>会员等级</label>
                                                        <div class="col-sm-6">
                                                            <input class="weui-switch" type="checkbox" name="FUNC_MEMBER_LEVEL" @if(sysOpen('FUNC_MEMBER_LEVEL') == '1') checked="checked" @endif />
          
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            @endif

                                            {{-- 积分余额 --}}
                                            @if (Config::get('web.FUNC_ORDER_CANCEL'))
                                                <div class="col-sm-4 item">
                                                    <div class="row">
                                                        <div class="col-sm-6">订单相关</div>
                                                        <div class="col-sm-6"><span>关闭</span>/<span>开启</span></div>
                                                    </div>
                                                    @if (Config::get('web.FUNC_ORDER_CANCEL'))
                                                    <div class="form-group">
                                                        <label for="FUNC_ORDER_CANCEL" class="col-sm-6 control-label"><i class="fa fa-circle-o"></i>订单取消</label>
                                                        <div class="col-sm-6">
                                                            <input class="weui-switch" type="checkbox" name="FUNC_ORDER_CANCEL" @if(sysOpen('FUNC_ORDER_CANCEL') == '1') checked="checked" @endif />
                   
                                                        </div>
                                                    </div>
                                                    @endif

                                                    @if (Config::get('web.FUNC_AFTERSALE'))
                                                    <div class="form-group">
                                                        <label for="FUNC_AFTERSALE" class="col-sm-6 control-label"><i class="fa fa-circle-o"></i> 退换货</label>
                                                        <div class="col-sm-6">
                                                            <input class="weui-switch" type="checkbox" name="FUNC_AFTERSALE" @if(sysOpen('FUNC_AFTERSALE') == '1') checked="checked" @endif />
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            @endif


                                            <div class="col-sm-4 item">
                                                <div class="row">
                                                    <div class="col-sm-6">{{ getSettingValueByKeyCache('credits_alias') }}余额</div>
                                                    <div class="col-sm-6"><span>关闭</span>/<span>开启</span></div>
                                                </div>
                                                @if (Config::get('web.FUNC_CREDITS'))
                                                <div class="form-group">
                                                    <label for="FUNC_CREDITS" class="col-sm-6 control-label"><i class="fa fa-circle-o"></i>{{ getSettingValueByKeyCache('credits_alias') }}</label>
                                                    <div class="col-sm-6">
                                                        <input class="weui-switch" type="checkbox" name="FUNC_CREDITS" @if(sysOpen('FUNC_CREDITS') == '1') checked="checked" @endif />
            
                                                    </div>
                                                </div>
                                                @endif

                                                @if (Config::get('web.FUNC_FUNDS'))
                                                <div class="form-group">
                                                    <label for="FUNC_FUNDS" class="col-sm-6 control-label"><i class="fa fa-circle-o"></i>余额</label>
                                                    <div class="col-sm-6">
                                                        <input class="weui-switch" type="checkbox" name="FUNC_FUNDS" @if(sysOpen('FUNC_FUNDS') == '1') checked="checked" @endif />
              
                                                    </div>
                                                </div>
                                                @endif

                                                @if (Config::get('web.FUNC_CASH_WITHDRWA'))
                                                <div class="form-group">
                                                    <label for="FUNC_CASH_WITHDRWA" class="col-sm-6 control-label"><i class="fa fa-circle-o"></i>提现</label>
                                                    <div class="col-sm-6">
                                                        <input class="weui-switch" type="checkbox" name="FUNC_CASH_WITHDRWA" @if(sysOpen('FUNC_CASH_WITHDRWA') == '1') checked="checked" @endif />
    
                                                    </div>
                                                </div>
                                                @endif
                                            </div>

                                            <div class="col-sm-4 item">
                                                <div class="row">
                                                    <div class="col-sm-6">其他相关</div>
                                                    <div class="col-sm-6"><span>关闭</span>/<span>开启</span></div>
                                                </div>

                                                @if (Config::get('web.FUNC_MANY_SHOP'))
                                                <div class="form-group">
                                                    <label for="FUNC_MANY_SHOP" class="col-sm-6 control-label"><i class="fa fa-circle-o"></i>分店管理</label>
                                                    <div class="col-sm-6">
                                                        <input class="weui-switch" type="checkbox" name="FUNC_MANY_SHOP" @if(sysOpen('FUNC_MANY_SHOP') == '1') checked="checked" @endif />
        
                                                    </div>
                                                </div>
                                                @endif


                                                @if (Config::get('web.FUNC_FAPIAO'))
                                                <div class="form-group">
                                                    <label for="FUNC_FAPIAO" class="col-sm-6 control-label"><i class="fa fa-circle-o"></i>开发票</label>
                                                    <div class="col-sm-6">
                                                        <input class="weui-switch" type="checkbox" name="FUNC_FAPIAO" @if(sysOpen('FUNC_FAPIAO') == '1') checked="checked" @endif />
                {{--                                         <div class="radio">
                                                            <label>
                                                                <input type="radio" name="FUNC_FAPIAO" value="0" @if( '0' == sysOpen('FUNC_FAPIAO') )checked="" @endif>关闭</label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="FUNC_FAPIAO" value="1" @if( '1' == sysOpen('FUNC_FAPIAO') )checked="" @endif>开启</label>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                                @endif

                                                @if (Config::get('web.FUNC_FOOTER'))
                                                <div class="form-group">
                                                    <label for="FUNC_FOOTER" class="col-sm-6 control-label"><i class="fa fa-circle-o"></i>底部信息</label>
                                                    <div class="col-sm-6">
                                                        <input class="weui-switch" type="checkbox" name="FUNC_FOOTER" @if(sysOpen('FUNC_FOOTER') == '1') checked="checked" @endif />
                {{--                                         <div class="radio">
                                                            <label>
                                                                <input type="radio" name="FUNC_FOOTER" value="0" @if( '0' == sysOpen('FUNC_FOOTER') )checked="" @endif>关闭</label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="FUNC_FOOTER" value="1" @if( '1' == sysOpen('FUNC_FOOTER') )checked="" @endif>开启</label>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                                @endif



                                                @if (Config::get('web.FUNC_YUNLIKE'))
                                                <div class="form-group">
                                                    <label for="FUNC_YUNLIKE" class="col-sm-6 control-label"><i class="fa fa-circle-o"></i>技术支持</label>
                                                    <div class="col-sm-6">
                                                        <input class="weui-switch" type="checkbox" name="FUNC_YUNLIKE" @if(sysOpen('FUNC_YUNLIKE') == '1') checked="checked" @endif />
                {{--                                         <div class="radio">
                                                            <label>
                                                                <input type="radio" name="FUNC_YUNLIKE" value="0" @if( '0' == sysOpen('FUNC_YUNLIKE') )checked="" @endif>关闭</label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="FUNC_YUNLIKE" value="1" @if( '1' == sysOpen('FUNC_YUNLIKE') )checked="" @endif>开启</label>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                                @endif

                                                @if (Config::get('web.FUNC_WECHATPAY'))
                                                <div class="form-group">
                                                    <label for="FUNC_WECHATPAY" class="col-sm-6 control-label"><i class="fa fa-circle-o"></i>微信支付</label>
                                                    <div class="col-sm-6">
                                                        <input class="weui-switch" type="checkbox" name="FUNC_WECHATPAY" @if(sysOpen('FUNC_WECHATPAY') == '1') checked="checked" @endif />
                {{--                                         <div class="radio">
                                                            <label>
                                                                <input type="radio" name="FUNC_WECHATPAY" value="0" @if( '0' == sysOpen('FUNC_WECHATPAY') )checked="" @endif>关闭</label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="FUNC_WECHATPAY" value="1" @if( '1' == sysOpen('FUNC_WECHATPAY') )checked="" @endif>开启</label>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                                @endif

                                                @if (Config::get('web.FUNC_PAYSAPI'))
                                                <div class="form-group">
                                                    <label for="FUNC_PAYSAPI" class="col-sm-6 control-label"><i class="fa fa-circle-o"></i>微信(个人)支付</label>
                                                    <div class="col-sm-6">
                                                        <input class="weui-switch" type="checkbox" name="FUNC_PAYSAPI" @if(sysOpen('FUNC_PAYSAPI') == '1') checked="checked" @endif />
                 {{--                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="FUNC_PAYSAPI" value="0" @if( '0' == sysOpen('FUNC_PAYSAPI') )checked="" @endif>关闭</label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="FUNC_PAYSAPI" value="1" @if( '1' == sysOpen('FUNC_PAYSAPI') )checked="" @endif>开启</label>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                                @endif

                                                @if (Config::get('web.FUNC_ALIPAY'))
                                                <div class="form-group">
                                                    <label for="FUNC_ALIPAY" class="col-sm-6 control-label"><i class="fa fa-circle-o"></i>支付宝</label>
                                                    <div class="col-sm-6">
                                                        <input class="weui-switch" type="checkbox" name="FUNC_ALIPAY" @if(sysOpen('FUNC_ALIPAY') == '1') checked="checked" @endif />
                {{--                                         <div class="radio">
                                                            <label>
                                                                <input type="radio" name="FUNC_ALIPAY" value="0" @if( '0' == sysOpen('FUNC_ALIPAY') )checked="" @endif>关闭</label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="FUNC_ALIPAY" value="1" @if( '1' == sysOpen('FUNC_ALIPAY') )checked="" @endif>开启</label>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                                @endif


                                                @if (Config::get('web.AUTH_CERTS'))
                                                <div class="form-group">
                                                    <label for="AUTH_CERTS" class="col-sm-6 control-label"><i class="fa fa-circle-o"></i>实名认证</label>
                                                    <div class="col-sm-6">
                                                        <input class="weui-switch" type="checkbox" name="AUTH_CERTS" @if(sysOpen('AUTH_CERTS') == '1') checked="checked" @endif />
                {{--                                         <div class="radio">
                                                            <label>
                                                                <input type="radio" name="FUNC_ALIPAY" value="0" @if( '0' == sysOpen('FUNC_ALIPAY') )checked="" @endif>关闭</label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="FUNC_ALIPAY" value="1" @if( '1' == sysOpen('FUNC_ALIPAY') )checked="" @endif>开启</label>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                                @endif

                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.box-body -->
                                   {{--  <div class="box-footer">
                                        <button type="submit" class="btn btn-primary pull-right" onclick="saveForm(1)">保存</button>
                                    </div> --}}
                                    <!-- /.box-footer --> 
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

@endsection

@include('admin.partials.imagemodel')

@section('scripts')
<script>
        function saveForm(index){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"/zcjy/settings/setting",
                type:"POST",
                data:$("#form"+index).serialize(),
                success: function(data) {
                  if (data.code == 0) {
                    layer.msg(data.message, {icon: 1});
                    //location.reload();
                  }else{
                    layer.msg(data.message, {icon: 5});
                  }
                },
                error: function(data) {
                  //提示失败消息

                },
            });
            
        }

        $(function(){
            //点击按钮触发
            $('input[type=checkbox]').change(function(){
                $.zcjyRequest('/zcjy/settings/setting',function(res){
                    if(res){
                           layer.msg(res, {icon: 1});
                    }
                },{[$(this).attr('name')]:$(this).prop('checked') ? 1 : 0},'POST');
            });
            //点击组触发
            $('.item').find('span').click(function(){
                    $(this).parent().parent().parent().find('input[type=checkbox]').prop('checked',$(this).index()).trigger('change');

            });
        });
    </script>
@endsection