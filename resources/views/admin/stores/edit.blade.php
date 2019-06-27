@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            编辑店铺
        </h1>
   </section>
   <div class="content">
       @include('flash::message')
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($store, ['route' => ['stores.update', $store->id], 'method' => 'patch']) !!}

                        @include('admin.stores.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
   @include('admin.partial.imagemodel')
@endsection

@include('admin.stores.js')