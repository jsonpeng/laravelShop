@extends('admin.layouts.app')

@section('content')
  <div class="container-fluid" style="padding: 30px 15px;">
    <div class="row">
        <div class="col-sm-3 col-lg-2">
            <ul class="nav nav-pills nav-stacked nav-email">
                <li class="{{ Request::is('zcjy/articlecats') ? 'active' : '' }}">
                    <a href="{!! route('articlecats.index') !!}"><i class="fa fa-bars"></i><span>话题分类</span></a>
                </li>
                <li class="{{ Request::is('zcjy/articlecats/create') ? 'active' : '' }}">
                    <a href="{!! route('articlecats.create') !!}"><i class="fa fa-bars"></i><span>添加分类</span></a>
                </li>
                <li class="{{ Request::is('zcjy/posts') ? 'active' : '' }}">
                    <a href="{!! route('posts.index') !!}"><i class="fa fa-newspaper-o"></i><span>话题列表</span></a>
                </li>
                <li class="{{ Request::is('zcjy/posts/create') ? 'active' : '' }}">
                    <a href="{!! route('posts.create') !!}"><i class="fa fa-newspaper-o"></i><span>添加话题</span></a>
                </li>
            </ul>
        </div>

        <div class="col-sm-9 col-lg-10">
            <div class="container">
                <section class="content-header">
                  <h1>编辑分类</h1>
                </section>
                <div class="content">
                  @include('adminlte-templates::common.errors')
                  <div class="box box-primary">
                    <div class="box-body">
                      <div class="row">
                        {!! Form::model($category, ['route' => ['articlecats.update', $category->id], 'method' => 'patch']) !!}
                          @include('admin.articlecats.fields', ['categories' => $categories, 'parent_id' => $category->parent_id, 'category' => $category])
                        {!! Form::close() !!}
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.partials.imagemodel')
@endsection