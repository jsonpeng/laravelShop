@extends('admin.layouts.app_shop')

@section('content')
 <div class="container-fluid" style="padding: 30px 15px;">
        <div class="row">
            <div class="col-sm-3 col-lg-2">
                @include('admin.layouts.leftnav.common')
            </div>

            <div class="col-sm-9 col-lg-10">
                    <section class="content-header">
                        <h1 class="pull-left">退款操作记录</h1>
                    </section>
                    <div class="content">
                        <div class="clearfix"></div>

                        @include('admin.partials.message')

                        <div class="clearfix"></div>
                        <div class="box box-primary">
                            <div class="box-body">
                                    @include('admin.refund_moneys.table')
                            </div>
                        </div>
                        <div class="text-center">
                        
                        </div>
                    </div>
            </div>
        </div>
</div>
@endsection

