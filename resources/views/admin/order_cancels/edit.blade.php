@extends('admin.layouts.app_shop')

@section('content')
    <section class="content-header">
        <h1>
            编辑
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary form">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($orderCancel, ['route' => ['orderCancels.update', $orderCancel->id], 'method' => 'patch']) !!}

                        @include('admin.order_cancels.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection