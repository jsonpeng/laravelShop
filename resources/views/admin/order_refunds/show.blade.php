@extends('admin.layouts.app_shop')

@section('content')
    <section class="content-header">
        <h1>
            Order Refund
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('admin.order_refunds.show_fields')
                    <a href="{!! route('orderRefunds.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
