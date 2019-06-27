@extends('admin.layouts.app')

@section('content')
<div class="container-fluid" style="padding: 30px 15px;">
    <div class="row">
        <div class="col-sm-3 col-lg-2">
            <ul class="nav nav-pills nav-stacked nav-email">
                <li class="{{ Request::is('zcjy/managers*') ? 'active' : '' }}">
                    <a href="{!! route('managers.index') !!}">
                        <span class="badge pull-right"></span>
                        <i class="fa fa-user"></i> 管理员设置
                    </a>
                </li>
                <li class="{{ Request::is('zcjy/roles*') ? 'active' : '' }}">
                    <a href="{!! route('roles.index') !!}">
                        <span class="badge pull-right"></span>
                        <i class="fa fa-users"></i> 角色设置
                    </a>
                </li>
                <li class="{{ Request::is('zcjy/permissions*') ? 'active' : '' }}">
                    <a href="{!! route('permissions.index') !!}">
                        <span class="badge pull-right"></span>
                        <i class="fa fa-key"></i> 权限设置
                    </a>
                </li>
            </ul>
        </div>

        <div class="col-sm-9 col-lg-10">
            <section class="content-header">
                <h1>
                    创建管理员
                </h1>
            </section>
            <div class="content">
                @include('adminlte-templates::common.errors')
                <div class="box box-primary form">

                    <div class="box-body">
                        <div class="row">
                            {!! Form::open(['route' => 'managers.store']) !!}

                                @include('admin.managers.fields',['roles' => $roles, 'selectedRoles' => [], 'edit' => false])

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_minimal-blue'
        });
        $('#password').attr('type','password');
        $('.selectShops').click(function(){
                $('.selectShops').prop('checked','');
                $(this).prop('checked','checked');
        });
    </script>
@endsection