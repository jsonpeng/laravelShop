@extends('admin.layouts.app_shop')

@section('content')
    <div class="container-fluid" style="padding: 30px 15px;">
        <div class="row">
            <div class="col-sm-3 col-lg-2">
                <ul class="nav nav-pills nav-stacked nav-email">
                    <li class="{{ Request::is('zcjy/productTypes*') ? 'active' : '' }}">
                        <a href="{!! route('productTypes.index') !!}">
                            <span class="badge pull-right"></span>
                            <i class="fa fa-user"></i> 模型
                        </a>
                    </li>
                    <li class="{{ Request::is('zcjy/specs*') ? 'active' : '' }}">
                        <a href="{!! route('specs.index') !!}">
                            <span class="badge pull-right"></span>
                            <i class="fa fa-users"></i> 规格
                        </a>
                    </li>
                    <li class="{{ Request::is('zcjy/productAttrs*') ? 'active' : '' }}">
                        <a href="{!! route('productAttrs.index') !!}">
                            <span class="badge pull-right"></span>
                            <i class="fa fa-key"></i> 属性
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-9 col-lg-10">
                <section class="content-header mb10-xs">
                    <h1 class="pull-left">商品属性</h1>
                    <h1 class="pull-right">
                       <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('productAttrs.create') !!}">添加</a>
                    </h1>
                </section>
                <div class="content pdall0-xs">
                    <div class="clearfix"></div>

                    @include('admin.partials.message')

                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="box-body">
                                @include('admin.product_attrs.table')
                        </div>
                    </div>
                    <div class="text-center">
                    
                    </div>
                </div>
            </div>
        </div>
              <div class="tc"><?php echo $productAttrs->appends('')->render(); ?></div>
    </div>
@endsection

