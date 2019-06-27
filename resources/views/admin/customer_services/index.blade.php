@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">客服列表</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('customerServices.create') !!}">添加</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('admin.partials.message')

        <div class="clearfix"></div>
        <div class="box box-primary form">
            <div class="box-body">
                    @include('admin.customer_services.table')
            </div>
        </div>
      
         <div class="text-center tc"><?php echo $customerServices->appends('')->render(); ?></div>
    
    </div>
@endsection

