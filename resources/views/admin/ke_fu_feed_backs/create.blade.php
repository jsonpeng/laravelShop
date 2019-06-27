@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            添加反馈
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'keFuFeedBacks.store']) !!}

                        @include('admin.ke_fu_feed_backs.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
