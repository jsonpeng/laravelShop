@extends('admin.layouts.app_shop')

@section('content')
    <section class="content-header">
        <h1>
            Refund Money
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('admin.refund_moneys.show_fields')
                    <a href="{!! route('refundMoneys.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
