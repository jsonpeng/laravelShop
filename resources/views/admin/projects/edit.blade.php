@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            编辑项目
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($projects, ['route' => ['projects.update', $projects->id], 'method' => 'patch']) !!}

                        @include('admin.projects.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection

@include('admin.projects.js')