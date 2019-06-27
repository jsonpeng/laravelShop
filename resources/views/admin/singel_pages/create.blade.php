@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid" style="padding: 30px 15px;">
        <div class="row">
            <div class="col-sm-3 col-lg-2">
                <ul class="nav nav-pills nav-stacked nav-email">
                    <li class="{{ Request::is('zcjy/banners*') || Request::is('zcjy/*/bannerItems*') ? 'active' : '' }}">
                        <a href="{!! route('banners.index') !!}"><i class="fa fa-edit"></i><span>横幅BANNER</span></a>
                    </li>
                    <li class="{{ Request::is('zcjy/notices*') ? 'active' : '' }}">
                        <a href="{!! route('notices.index') !!}"><i class="fa fa-envelope-o"></i><span>通知消息</span></a>
                    </li>

                    @if(Config::get('web.FUNC_FOOTER'))
                    <li class="{{ Request::is('zcjy/singelPages*') ? 'active' : '' }}">
                        <a href="{!! route('singelPages.index') !!}"><i class="fa fa-edit"></i><span>业务介绍</span></a>
                    </li>
                    @endif
                </ul>
            </div>

            <div class="col-sm-9 col-lg-10">
                <div class="container">
                    <section class="content-header">
                        <h1>
                            添加单页面
                        </h1>
                    </section>
                    <div class="content">
                        @include('adminlte-templates::common.errors')
                        <div class="box box-primary form">

                            <div class="box-body">
                                <div class="row">
                                    {!! Form::open(['route' => 'singelPages.store']) !!}

                                        @include('admin.singel_pages.fields')

                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
@endsection


@section('scripts')
    @include('admin.singel_pages.partials.js')
@endsection