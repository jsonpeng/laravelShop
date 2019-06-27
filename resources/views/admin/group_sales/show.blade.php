@extends('admin.layouts.app_promp')

@section('content')
    <section class="content-header">
        <h1>
            Group Sale
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('admin.group_sales.show_fields')
                    <a href="{!! route('groupSales.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
