@extends('admin.layouts.app_shop')

@section('content')
 <div class="container-fluid" style="padding: 30px 15px;">
        <div class="row">
            <div class="col-sm-3 col-lg-2">
                @include('admin.layouts.leftnav.common')
            </div>

            <div class="col-sm-9 col-lg-10">
                <section class="content-header">
                    <h1 class="pull-left">商品评价列表</h1>
                    <h1 class="pull-right">
                        <a class="btn btn-primary pull-right" style="margin-bottom: 5px" href="{!! route('productEvals.create') !!}">添加商品评价</a>
                    </h1>
                </section>
                <div class="content pdall0-xs">
                    <div class="clearfix"></div>

                    @include('admin.partials.message')

                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="box-body">
                                @include('admin.product_evals.table')
                        </div>
                    </div>

                    <div class="text-center">
                            {!! $productEvals->appends('')->links() !!}
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection

