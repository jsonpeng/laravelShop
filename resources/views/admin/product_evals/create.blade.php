@extends('admin.layouts.app_shop')

@section('content')
    <section class="content-header">
        <h1>
            添加商品评价
        </h1>
    </section>
    <div class="content pdall0-xs">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'productEvals.store']) !!}

                        @include('admin.product_evals.fields')
                        
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    @include('admin.partials.imagemodel')

@endsection

