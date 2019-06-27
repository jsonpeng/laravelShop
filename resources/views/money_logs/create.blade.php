@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Money Log
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'moneyLogs.store']) !!}

                        @include('money_logs.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
