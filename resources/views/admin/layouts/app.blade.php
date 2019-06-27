<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ getSettingValueByKeyCache('name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/iCheck/1.0.2/skins/all.css">
    {{-- weui --}}
    <link rel="stylesheet" href="{{ asset('vendor/weui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminLTE/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminLTE/css/skins/skin-black-light.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert/lib/sweet-alert.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/multisel/css/bootstrap-multiselect.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/daterangepicker/daterangepicker-bs3.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datepicke/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/ionicons/2.0.1/css/ionicons.min.css">

    @yield('css')
</head>

<body class="skin-blue">
    <div>
        <div style="max-width: 1500px; margin: 0 auto;">
            @if (auth('admin')->check())
            <div class="" style="position: relative;">
                <!-- Main Header -->
                <header class="main-header">

                    <!-- Logo -->
                    <a href="javascript:;" class="logo">
                        <b>{!! getSettingValueByKeyCache('name') !!}</b>
                    </a>

                    <!-- Header Navbar -->
                    <nav class="navbar navbar-static-top" role="navigation">
                        <!-- Sidebar toggle button-->
                        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                            <span class="sr-only">Toggle navigation</span>
                        </a>

                    
                        <a href="/zcjy/settings/setting" class="sidebar-toggle fourset active">
                                    <span>系统</span>
                        </a>

                        <a href="{!! route('products.index') !!}" class="sidebar-toggle fourset">
                                    <span>商城</span>
                        </a>
                        
                        @if(funcOpen('FUNC_DISTRIBUTION'))
                        <a href="{!! route('distributions.lists') !!}" class="sidebar-toggle fourset">
                                    <span>分销</span>
                        </a>
                        @endif
                        
                        @if(funcOpen('FUNC_PRODUCT_PROMP') || funcOpen('FUNC_ORDER_PROMP') || funcOpen('FUNC_FLASHSALE') || funcOpen('FUNC_TEAMSALE') || funcOpen('FUNC_COUPON'))
                        <a href="{!! route('coupons.index') !!}" class="sidebar-toggle fourset">
                                    <span>促销</span>
                        </a>
                        @endif


                        <!-- Navbar Right Menu -->
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">
                                <li class="dropdown user user-menu">
                                    <!-- Menu Toggle Button -->
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <!-- The user image in the navbar-->
                                        <img src="{!! getSettingValueByKeyCache('logo') !!}" onerror="javascript:this.src='/images/logo.png';"
                                             class="user-image" alt="User Image"/>
                                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                        <span class="hidden-xs">{!! auth('admin')->user()->name !!}</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- The user image in the menu -->
                                        <li class="user-header">
                                            <img src="{!! getSettingValueByKeyCache('logo') !!}" onerror="javascript:this.src='/images/logo.png';"
                                                 class="img-circle" alt="User Image"/>
                                            <p>
                                                {!! auth('admin')->user()->name !!}
                                                <small>注册日期 {!! auth('admin')->user()->created_at->format('M. Y') !!}</small>
                                            </p>
                                        </li>
                                        <!-- Menu Footer-->
                                        <li class="user-footer">
                                            <div class="pull-left">
                                                <a target="_blank" href="/zcjy/password/reset" class="btn btn-default btn-flat">重置密码</a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="{!! url('/zcjy/logout') !!}" class="btn btn-default btn-flat">退出</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </header>

                <!-- Left side column. contains the logo and sidebar -->
                @include('admin.layouts.sidebar')
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    @yield('content')
                </div>

                <!-- Main Footer 
                <footer class="main-footer" style="max-height: 100px;text-align: center">
                    <strong>Copyright 2015-2017 <a href="#">智琛佳源科技有限公司</a>.</strong> All rights reserved.
                </footer>-->

            </div>
        @else
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->
                        <a class="navbar-brand" href="http://www.wiswebs.com">
                            武汉智琛佳源科技有限公司
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            <li><a href="http://www.wiswebs.com">武汉智琛佳源科技有限公司</a></li>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            <li><a href="{!! url('/auth/login') !!}">登录</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

        @endif
        </div>
    </div>
    

    <!-- jQuery 2.1.4 -->
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdn.bootcss.com/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdn.bootcss.com/iCheck/1.0.2/icheck.min.js"></script>
    <script src="https://cdn.bootcss.com/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdn.bootcss.com/moment.js/2.18.1/locale/zh-cn.js"></script>



    <!-- AdminLTE App -->
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.3/js/app.min.js"></script-->
    <script type="text/javascript" src="{{ asset('vendor/adminLTE/js/app.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/sweetalert/lib/sweet-alert.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/tinymce/jquery.tinymce.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/multisel/js/bootstrap-multiselect.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datepicke/js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datepicke/locales/bootstrap-datepicker.zh-CN.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/select/js/bootstrap-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/layer/layer.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/zcjy.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin.js') }}"></script>
    <!-- scroll beautiful -->
{{--     <script type="text/javascript" src="{{ asset('vendor/scroll/scrollbot.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/scroll/scrollreveal.min.js') }}"></script>
    <script type="text/javascript">
        var custom = new scrollbot("body");
        custom.setStyle({height:2});
        var onscrollfollower = document.createElement("div");
        onscrollfollower.style.width = "100%";
        onscrollfollower.style.height = "100%";
        onscrollfollower.style.backgroundColor = "#4c84ff";
        onscrollfollower.style.position = "absolute";
        onscrollfollower.style.bottom = "100%";
        onscrollfollower.style.right = 0;
        custom.scrollBarHolder.appendChild(onscrollfollower);
        custom.onScroll(function(){onscrollfollower.style.bottom = 100 - parseFloat(this.scrollBar.style.top) + "%";});
        document.onreadystatechange = function(){
          
            custom.refresh();
       
        }
    </script> --}}
    @yield('scripts')
    <script type="text/javascript">
        @if(isset($model_required))
            $.zcjyRequiredParam('{!! $model_required !!}');
        @endif

        tinymce.init({
        selector: 'textarea.intro',
        height: 500,
        theme: 'modern',
        language: 'zh_CN',
        plugins: ['advlist autolink lists link image charmap print preview hr anchor pagebreak', 'searchreplace wordcount visualblocks visualchars code fullscreen', 'insertdatetime media nonbreaking save table contextmenu directionality', 'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help responsivefilemanager'],
        toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | responsivefilemanager',
        toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
        image_advtab: true,
        external_filemanager_path: "/filemanager/",
        filemanager_title: "图片",
        external_plugins: { "filemanager": "/vendor/tinymce/plugins/responsivefilemanager/plugin.min.js" },
        templates: [{ title: 'Test template 1', content: 'Test 1' }, { title: 'Test template 2', content: 'Test 2' }],
        content_css: [
            //'//www.tinymce.com/css/codepen.min.css'
        ]
    });
    //表格隐藏与显示
    $('.fa').click(function(){
       var type=$(this).data('type');
       var status= $(this).parent().parent().parent().children('.box-body').data('status');
       var functions =$(this).data('function');
        if(functions =='switch-table'){
            console.log($(this).parent().parent().parent().children('.box-body'));
       if(status=="show"){
            $(this).parent().parent().parent().children('.box-body').hide();
            $(this).parent().parent().parent().children('.box-body').data('status','hide');
       }else{
        $(this).parent().parent().parent().children('.box-body').show();
        $(this).parent().parent().parent().children('.box-body').data('status','show');
       }
   }else{
    return false;
   }
    });

    $('#refresh').click(function(){
                 layer.msg('清理中', {
                  icon: 16
                  ,shade: 0.01
                });
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
            $.ajax({
                url:'/clearCache',
                type:'post',
                success:function(data){
                    if(data.status){
                  setTimeout(function(){
                layer.closeAll('loading');
                    layer.msg('清理完成', {
                    icon: 1,
                    skin: 'layer-ext-moon' 
                    });
                }, 1500);
                    }else{
                layer.open({
                    content: '未知错误!'
                    ,skin: 'msg'
                    ,time: 2 
                  });
                        return false;
                    }
                }
            })
    });
    </script>
</body>
</html>