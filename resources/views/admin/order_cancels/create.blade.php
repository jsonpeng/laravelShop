@extends('admin.layouts.app_shop')

@section('content')
    <section class="content-header">
        <h1>
            Order Cancel
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary form">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'orderCancels.store']) !!}

                        @include('admin.order_cancels.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
