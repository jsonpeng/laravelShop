@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Order Cancel Image
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($orderCancelImage, ['route' => ['orderCancelImages.update', $orderCancelImage->id], 'method' => 'patch']) !!}

                        @include('order_cancel_images.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection