@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            编辑国家馆
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary form">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($country, ['route' => ['countries.update', $country->id], 'method' => 'patch']) !!}

                        @include('admin.countries.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
   @include('admin.partial.imagemodel')
@endsection