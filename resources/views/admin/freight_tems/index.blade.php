@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid" style="padding: 30px 15px;">
        <div class="row">
            <div class="col-sm-3 col-lg-2">
                <ul class="nav nav-pills nav-stacked nav-email">
                    <li class="{{ Request::is('zcjy/cities*') ? 'active' : '' }}">
                        <a href="{!! route('cities.index') !!}">
                            <span class="badge pull-right"></span>
                            <i class="fa fa-user"></i> 地区管理
                        </a>
                    </li>
                    <li class="{{ Request::is('zcjy/freightTems*') ? 'active' : '' }}">
                        <a href="{!! route('freightTems.index') !!}">
                            <span class="badge pull-right"></span>
                            <i class="fa fa-users"></i> 运费模板
                        </a>
                    </li>

                </ul>
            </div>

            <div class="col-sm-9 col-lg-10">
                <section class="content-header">
                    <h1 class="pull-left">运费模板列表</h1>
                    <h1 class="pull-right">
                       <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('freightTems.create') !!}">添加</a>
                    </h1>
                </section>
                <div class="content">
                    <div class="clearfix"></div>

                    @include('admin.partials.message')

                    <div class="clearfix"></div>
                    <div class="box box-primary form">
                        <div class="box-body">
                                @include('admin.freight_tems.table')
                        </div>
                    </div>
                    <div class="text-center">
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
    function showFreightTemList(cid){
         var url = "/zcjy/cities/frame/freighttem/"+cid;
            layer.open({
                type: 2,
                title: '查看运费模板信息',
                shadeClose: true,
                shade: 0.2,
                area: ['60%', '60%'],
                content: url
            });
    }
</script>
@endsection
