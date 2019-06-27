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
                        <h1 class="pull-left">文章列表</h1>
                        <h1 class="pull-right">
                            <a class="btn btn-primary pull-right" href="{!! route('posts.create') !!}" >添加</a>
                        </h1>
                    </section>
                    <div class="content">
                        <div class="clearfix"></div>
                        @include('admin.partials.message')
                        <div class="clearfix"></div>
                        <div class="box box-primary">
                            <div class="box-body">
                                <form id="form_search">
                                    <div class="form-group col-md-2">
                                        <label>名称</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="" @if (array_key_exists('name', $input)) value="{{$input['name']}}"@endif ></div>

                                    <div class="form-group col-md-2">
                                        <label>文章分类</label>
                                        <select class="form-control" name="cat">
                                            <option value="全部" @if (!array_key_exists('cat', $input)) selected="selected" @endif>全部</option>
                                            @foreach($categories as $category)
                                            <option value="{{$category->
                                                id}}" @if (array_key_exists('cat', $input) && $input['cat'] == $category->id) selected="selected" @endif>@if($category->parent_id)&nbsp;&nbsp;@endif{{$category->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>发布状态</label>
                                        <select class="form-control" name="status">
                                            <option value="全部" @if (!array_key_exists('status', $input) || $input['status'] == '全部') selected="selected" @endif>全部</option>
                                            <option value="1" @if (array_key_exists('status', $input) && $input['status'] == '1') selected="selected" @endif>已发布</option>
                                            <option value="0" @if (array_key_exists('status', $input) && $input['status'] == '0') selected="selected" @endif>草稿</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-1">
                                        <label>操作</label>
                                        <button type="submit" class="btn btn-primary pull-right form-control" onclick="search()">查询</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="box box-primary">
                            <div class="box-body">@include('admin.posts.table')</div>
                        </div>
                        <div style="text-align: center;">{{$posts->appends($input)->links()}}</div>
                    </div>
              </div>
          </div>
      </div>
  </div>

@endsection

@section('js')

@endsection