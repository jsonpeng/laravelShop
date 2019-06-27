@extends('admin.layouts.app_shop')

@section('content')
   <div class="content pdall0-xs">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary form">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($brand, ['route' => ['brands.update', $brand->id], 'method' => 'patch']) !!}
                        
                        {!! Form::hidden('brand_id', $brand->id) !!} 
                        @include('admin.brands.fields', ['brand' => $brand])

                   {!! Form::close() !!}

               </div>
           </div>
       </div>
   </div>

   @include('admin.partials.imagemodel')
@endsection