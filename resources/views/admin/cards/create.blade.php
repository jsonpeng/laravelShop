@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            添加{{ getSettingValueByKeyCache('credits_alias') }}卡
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'cards.store']) !!}

                        @include('admin.cards.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
