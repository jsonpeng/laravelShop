@extends('admin.layouts.app_shop')

@section('content')
    <div class="container-fluid" style="padding: 30px 15px;">
        <div class="row">
            <div class="col-sm-3 col-lg-2">
                @include('admin.layouts.leftnav.common')
            </div>

            <div class="col-sm-9 col-lg-10">

                <section class="content-header mb10-xs">
                    <h1 class="pull-left">商品模型</h1>
                    <h1 class="pull-right">
                        <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('productTypes.create') !!}">添加</a>
                    </h1>
                </section>
                <div class="content pdall0-xs">
                    <div class="clearfix"></div>
                    @include('admin.partials.message')
                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="box-body">@include('admin.product_types.table')</div>
                    </div>
                    <div class="text-center"></div>
                </div>
            </div>
        </div>
         <div class="tc"><?php echo $productTypes->appends('')->render(); ?></div>
    </div>
@endsection