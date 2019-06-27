@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            添加客服
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary form">

            <div class="box-body">

                    {!! Form::open(['route' => 'customerServices.store']) !!}

                        @include('admin.customer_services.fields')

                    {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection

@include('admin.partials.imagemodel')
