@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Order Cancel Image
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'orderCancelImages.store']) !!}

                        @include('order_cancel_images.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
