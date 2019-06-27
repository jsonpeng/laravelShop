@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            添加店铺分类
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'cats.store']) !!}

                        @include('admin.cats.fields')

                    {!! Form::close() !!}
                </div>
            </div>
            
        </div>
    </div>
    @include('admin.partials.imagemodel')
@endsection
