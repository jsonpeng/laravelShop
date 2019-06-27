@extends('admin.layouts.app_shop')

@section('content')
    <section class="content-header mb10-xs">
        <h1>
            添加品牌列表
        </h1>
    </section>
    <div class="content pdall0-xs">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary form">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'brands.store']) !!}

                        @include('admin.brands.fields', ['brand' => null])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    @include('admin.partials.imagemodel')

@endsection

