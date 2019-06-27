@extends('admin.layouts.app_shop')

@section('content')
    <section class="content-header">
        <h1>
            编辑商品评价
        </h1>
   </section>
   <div class="content pdall0-xs">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($productEval, ['route' => ['productEvals.update', $productEval->id], 'method' => 'patch']) !!}
                        
                        @include('admin.product_evals.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>

       @include('admin.partials.imagemodel')

   </div>
@endsection

