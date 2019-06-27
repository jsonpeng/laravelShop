@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Ke Fu Feed Back
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('ke_fu_feed_backs.show_fields')
                    <a href="{!! route('keFuFeedBacks.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
